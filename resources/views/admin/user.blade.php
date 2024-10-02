@extends('admin.layouts.app')

@section('content')
<style>
    .hover-color a:hover{
        background-color: gold;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User List <span style="float: right"><a href="{{route('admin.create.user')}}" class="btn btn-dark btn-sm" style="margin-right: 10px">Add User</a><a href="{{route('admin.users.export')}}" class="btn btn-dark btn-sm">Export user</a></span></div>
                <div class="card-body">
                    @if (session('saved'))
                        <div class="alert alert-success" role="alert">
                            {{ session('saved') }}
                        </div>
                    @endif
                    <table class="table table-hover">
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
                    <div class="d-flex justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
