@extends('layouts.app')

@section('content')
<style>
    .commentList {
        padding:0;
        max-height:300px;
        overflow-y:auto;
        overflow-x: hidden;
    }
    .commentText p {
        margin:0;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                <a href="{{route('task')}}" class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Back | View all Task
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    @if (session('saved'))
                        <div class="alert alert-success" role="alert">
                            {{ session('saved') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="co-md-12">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{$task->title}}@if($task->status == 2)<span class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                                        </svg></span>@endif

                                        @if($task->created_by == Auth::id())
                                            <span style="float: right; padding-right:15px">
                                                <a href="" style="text-decoration: none; margin-right:5px" data-bs-toggle="modal" data-bs-target="#editTaskModel">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                                    </svg>
                                                </a>
                                                <span class="text-muted">|</span>
                                                <a href="" style="text-decoration: none; margin-left:5px" data-bs-toggle="modal" data-bs-target="#danger-alert-modal">
                                                    <span class="text-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </span>
                                        @endif
                                    </h5>
                                    <div class="mb-3">
                                        <small>{{date("d M, Y h:i A", strtotime($task->created_at))}}</small>
                                    </div>
                                    <p class="mb-0" style="text-align: justify">{{$task->description}}</p>
                                    @if($task->task_attachment != null)
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <a href="{{asset($task->task_attachment)}}" target="_blank" style="text-decoration: none !important;">
                                                    <div class="card mb-0" style="background-color:#e9e9e9;">
                                                        <div class="card-body p-0">
                                                            <div style="display: flex">
                                                                <div style="width: 70%;padding: 13px 0 13px 13px">
                                                                    View Attachment
                                                                </div>
                                                                <div style="background-color:#ff4d4d; width:30%; padding:13px 13px 13px 0; border-radius: 0px 6px 6px 0;" class="text-center text-white">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                                                                        <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z"/>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h5>Task Status & Assigned User</h5>
                                    <hr>
                                    <form action="{{route('status', $task->id)}}" method="post">
                                        @csrf()
                                        <div class="row">
                                            <div class="col-md-5">created_by
                                                Task is assigned by: <br><h3>{{ \App\Models\Admin::find($task->created_by)->name ?? 'Not Assigned' }}</h3>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="userAssign">Select Task Status</label>
                                                <select id="userAssign" class="form-control" name="status" required>
                                                    <option value="0" @selected($task->status == 0)>Pending</option>
                                                    <option value="1" @selected($task->status == 1)>In progress</option>
                                                    <option value="2" @selected($task->status == 2)>Completed</option>
                                                </select>
                                                <small class="{{$text_color}}">Current Status: {{$task_status}}</small>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-dark" style="width: 100%">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Alert Modal -->
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                        <h4 class="mt-2">Are you Sure?</h4>
                        <p class="mt-3">Do you want to delete this task?</p>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Cancle</button>
                        <a href="{{route('delete_task',$task->id)}}" class="btn btn-light my-2">Yes, Delete!</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit model -->
    <div class="modal fade" id="editTaskModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update_task',$task->id)}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf()
                        <div class="mb-3">
                            <label for="title">Task Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Task Title" required id="title" value="{{$task->title}}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Attachment:</label>
                            <input type="file" class="form-control" name="task_attachment">
                            <small><a href="{{asset($task->task_attachment)}}" target="_blank">Click here to view current attachment</a></small>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control" rows="2" placeholder="Description" required id="description" name="description">{{$task->description}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit model end -->

</div>
@endsection
