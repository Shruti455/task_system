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
                <div class="card-header">Create User</div>
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
                                    <form class="form-inline" action="{{route('admin.save_user')}}" method="POST" id="userSave">
                                        @csrf()
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="name">Name</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label for="phone">Phone</label>
                                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="name" autofocus>

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="email">Email Address</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="password">Password</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="password-confirm">Confirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                            </div>
                                            <div class="col-md-8">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-dark" style="width: 100%">Save User</button>
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
</div>  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        // Validate the form
        $("#userSave").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                    remote: {
                        url: "{{ route('checkEmailUnique') }}",  // Make sure to create this route to check uniqueness
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}"
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    maxlength: "Name cannot be longer than 255 characters"
                },
                phone: {
                    required: "Please enter your phone number",
                    digits: "Please enter only digits",
                    minlength: "Phone number must be 10 digits",
                    maxlength: "Phone number must be 10 digits"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                    maxlength: "Email cannot be longer than 255 characters",
                    remote: "Email already exists"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-md-12').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection