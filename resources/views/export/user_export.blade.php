<html>
    <head>
        <title>Task Export</title>
    </head>
    <body>
        <!-- Tasks Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">S No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Register Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ date("d M, Y h:i A", strtotime($user->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- No Tasks Message -->
        @if($users->isEmpty())
            <div class="alert alert-warning" role="alert">
                No tasks available to display.
            </div>
        @endif

    </body>
</html>