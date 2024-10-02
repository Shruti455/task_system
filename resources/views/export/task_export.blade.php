<html>
    <head>
        <title>Task Export</title>
    </head>
    <body>
        <!-- Tasks Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><strong>ID</strong></th>
                    <th><strong>Title</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Created At</strong></th>
                    <th><strong>Assigned User</strong></th>
                    <th><strong>Created</strong></th>
                    <th>S<strong>tatus</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            @if(strlen($task->description) <= 100)
                                {{ $task->description }}
                            @else
                                {{ substr($task->description, 0, 100) . ' ...' }}
                            @endif
                        </td>
                        <td>{{ date("d M, Y h:i A", strtotime($task->created_at)) }}</td>
                        <td>
                            @if($task->assigned_user)
                                {{ \App\Models\User::find($task->assigned_user)->name ?? 'Not Assigned' }}
                            @else
                                Not Assigned
                            @endif
                        </td>
                        <td>
                            @if($task->created_by)
                                {{ \App\Models\Admin::find($task->created_by)->name ?? 'Not Assigned' }}
                            @else
                                Not Assigned
                            @endif
                        </td>
                        <td>
                            @if($task->status == 1)
                                <span class="badge bg-info">In progress</span>
                            @elseif($task->status == 2)
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- No Tasks Message -->
        @if($tasks->isEmpty())
            <div class="alert alert-warning" role="alert">
                No tasks available to display.
            </div>
        @endif

    </body>
</html>