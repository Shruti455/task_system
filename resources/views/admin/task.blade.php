@extends('admin.layouts.app')

@section('content')
<style>
    .hover-color a:hover{
        background-color: gold;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Task</div>
                <div class="card-body">
                    @if (session('saved'))
                        <div class="alert alert-success" role="alert">
                            {{ session('saved') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="co-md-12">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Create Task</h5><hr>
                                    <form class="form-inline" role="form" action="{{route('admin.create_task')}}" method="POST" enctype="multipart/form-data">
                                        @csrf()
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="title">Task Title</label>
                                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Task Title" value="{{ old('title') }}" required id="title">
                                                
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label>Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Description" required id="description" name="description">{{ old('description') }}</textarea>
                                                
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-8">
                                                <input type="file" class="form-control" name="task_attachment">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-dark" style="width: 100%">Create Task</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 p-2" style="background-color: #e0dede; padding: 10px;">
                                <div class="d-flex justify-content-between">
                                    <div style="width: 70%;">
                                        <input type="text" id="search" {{($tasks->isEmpty()) ? 'disabled' : ''}} placeholder="Search tasks..." class="form-control" onkeyup="searchTasks()">
                                    </div>
                                    <div>
                                        <a href="{{route('admin.tasks.export')}}" class="btn btn-dark" {{($tasks->isEmpty()) ? 'disabled' : ''}}>Export Tasks</a>
                                    </div>
                                </div>
                                <small><span class="text-danger">*</span>Click on task to see details, assign user or change status.</small>
                            </div>                            
                        </div>
                        

                        <div id="taskList">
                            @if($tasks->isEmpty())
                                <div style="text-align: center; padding: 20px;">
                                    <p>There is no task</p>
                                </div>
                            @else
                                @foreach ($tasks as $task)
                                    <div class="col-md-12 hover-color task-item">
                                        <a href="{{ route('admin.task_details', $task->id) }}" style="text-decoration: none !important;">
                                            <div class="card bg-light mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $task->title }}</h5>
                                                    <p class="card-text mb-0" style="text-align: justify">
                                                        @if(strlen($task->description) <= 200)
                                                            {{ $task->description }}
                                                        @else
                                                            {{ substr($task->description, 0, 200) . ' ... Read more' }}
                                                        @endif
                                                    </p>
                                                    <small class="card-text">
                                                        {{ date("d M, Y h:i A", strtotime($task->created_at)) }} | 
                                                        <span class="badge bg-dark">
                                                            @if($task->assigned_user == null)
                                                                Not Assigned
                                                            @else
                                                                Assigned to: {{ $task->assigned_users->name }} | {{ $task->assigned_users->email }}
                                                            @endif
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
</div>
<script>
    function searchTasks() {
        // Get the value from the search input
        const searchValue = document.getElementById('search').value.toLowerCase();
        // Get all task items
        const tasks = document.querySelectorAll('.task-item');
    
        // Loop through the tasks and hide/show based on the search value
        tasks.forEach(task => {
            const title = task.querySelector('.card-title').textContent.toLowerCase();
            if (title.includes(searchValue)) {
                task.style.display = '';  // Show the task
            } else {
                task.style.display = 'none';  // Hide the task
            }
        });
    }
</script>    
@endsection
