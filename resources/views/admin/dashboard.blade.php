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
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Task</h5><hr>
                                    <h1>{{$data['total_task']}}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Completed Task</h5><hr>
                                    <h1>{{$data['completed_task']}}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Not Assigned Task</h5><hr>
                                    <h1>{{$data['not_assigned_task']}}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total User</h5><hr>
                                    <h1>{{$data['total_user']}}</h1>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
