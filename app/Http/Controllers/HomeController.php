<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class HomeController extends Controller
{
    public function task()
    {
        $id = Auth::user()->id;
        $tasks = Task::where('assigned_user',$id)->where('delete_task',0)->orderBy('id', 'DESC')->get();
        return view('task', compact('tasks'));
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
                $task_status = "Open";
            }
            return view('task_detail',compact('task','users','text_color','task_status'));
        }else{
            return redirect()->route('task')->with('error', 'Something Went wrong!');
        }
    }

    function status(Request $request, $id)
    {
        $data = $request->except('_token');
        Task::where('id',$id)->update($data);
        return redirect()->back()->with('saved', 'Task status updated successfully');
    }

    function email_check(Request $request) {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();
        return response()->json(!$exists);
    }
}
