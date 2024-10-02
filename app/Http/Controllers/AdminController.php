<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Exports\TasksExport;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function dashboard()
    {
        $data['total_task'] = Task::where('delete_task',0)->count();
        $data['completed_task'] = Task::where('status',2)->where('delete_task',0)->count();
        $data['not_assigned_task'] = Task::where('assigned_user',null)->where('delete_task',0)->count();
        $data['total_user'] = User::count();
        return view('admin.dashboard', compact('data'));
    }

    public function task()
    {
        $tasks = Task::where('delete_task',0)->orderBy('id', 'DESC')->get();
        return view('admin.task', compact('tasks'));
    }

    function create_task(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required'
        ]);

        $task = $request->except('_token');
        $task['created_by'] = Auth::user()->id;

        if($request->has('task_attachment'))
        {
            $image = $request->task_attachment;
            $image_name = 'T'.time().'_'.rand(111111111,999999999).'.'.$image->getClientOriginalExtension();
            $image_path = public_path('document/task');
            $image->move($image_path, $image_name);
            
            $task['task_attachment'] = "document/task/".$image_name;
        }

        Task::create($task);
        return redirect()->back()->with('saved', 'Task Created Successfully');
    }

    public function task_details($id)
    {
        $task = Task::where('id',$id)->where('delete_task',0)->first();
        if(!empty($task)){
            $users = User::all()->except(Auth::id());
        
            if($task->status == 1){
                $text_color = "text-info";
                $task_status = "In progress";
            }elseif($task->status == 2){
                $text_color = "text-success";
                $task_status = "Completed";
            }else{
                $text_color = "text-warning";
                $task_status = "Pending";
            }
            return view('admin.task_detail',compact('task','users','text_color','task_status'));
        }else{
            return redirect()->route('admin.task')->with('error', 'Something Went wrong!');
        }
    }

    function user_and_status(Request $request, $id)
    {
        $data = $request->except('_token');
        Task::where('id',$id)->update($data);
        return redirect()->back()->with('saved', 'Task status or user updated successfully');
    }

    function delete_task($id)
    {
        $data['delete_task'] = 1;

        Task::where('id',$id)->update($data);
        return redirect()->route('admin.task')->with('saved', 'Task deleted');
    }

    function update_task(Request $request, $id)
    {
        $task = $request->except('_token');

        if($request->has('task_attachment'))
        {
            $image = $request->task_attachment;
            $image_name = 'T'.time().'_'.rand(111111111,999999999).'.'.$image->getClientOriginalExtension();
            $image_path = public_path('document/task');
            $image->move($image_path, $image_name);
            
            $task['task_attachment'] = "document/task/".$image_name;
        }

        Task::where('id',$id)->update($task);
        return redirect()->back()->with('saved', 'Task Updated');
    }

    public function task_export()
    {
        $tasks = Task::where('delete_task',0)->get();
        return Excel::Download(new TasksExport($tasks), "tasks.xlsx");
    }

    public function user_list()
    {
        $users = User::paginate(5);
        return view('admin.user', compact('users'));
    }

    public function user_export()
    {
        $users = User::get();
        return Excel::Download(new UserExport($users), "users.xlsx");
    }

    public function create_user()
    {
        return view('admin.create_user');
    }

    public function save_user(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create a new user
        User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect to the user list with a success message
        return redirect()->route('admin.user_list')->with('saved', 'User Saved Successfully');
    }

}
