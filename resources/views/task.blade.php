@extends('layouts.app')

@section('content')
<style>
    .hover-color a:hover{
        background-color: gold;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task</div>
                <div class="card-body">
                    <div class="row">
                        @if($tasks->isEmpty())
                            <div style="text-align: center; padding: 20px;">
                                <p>There is no task for you</p>
                            </div>
                        @else
                            @foreach ($tasks as $task)
                                <div class="co-md-12 hover-color">
                                    <a href="{{route('task_details',$task->id)}}" style="text-decoration: none !important;">
                                        <div class="card bg-light mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$task->title}}</h5>
                                                <p class="card-text mb-0" style="text-align: justify">
                                                    @if(strlen($task->description)<= 200)
                                                        {{$task->description}}
                                                    @else
                                                        {{substr($task->description,0,200) . ' ... Read more'}}
                                                    @endif
                                                </p>
                                                <small class="card-text">
                                                    {{date("d M, Y h:i A", strtotime($task->created_at))}} | 
                                                    <span class="badge bg-dark">
                                                        Assigned by: {{ \App\Models\Admin::find($task->created_by)->name ?? 'Not Assigned' }}
                                                    </span> |
                                                    @if($task->status == 1)
                                                        <span class="badge bg-info">In progress</span>
                                                    @elseif($task->status == 2)
                                                        <span class="badge bg-success">Completed</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
