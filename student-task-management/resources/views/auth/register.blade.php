@extends('guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="h3 mb-3 font-weight-normal">Create Account</h2>
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="72" height="72" class="mb-3">
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password"
                                   name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" required>
                        </div>

                        @if(config('auth.registration_requires_role'))
                        <div class="mb-3">
                            <label class="form-label">Register as</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role"
                                       id="role_student" value="student" checked>
                                <label class="form-check-label" for="role_student">
                                    Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role"
                                       id="role_teacher" value="teacher">
                                <label class="form-check-label" for="role_teacher">
                                    Teacher
                                </label>
                            </div>
                        </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>

                        <div class="mt-3 text-center">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Sign in
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
