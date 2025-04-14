@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">Profile</h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Profile Information</h5>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', auth()->user()->phone) }}"
                        class="form-control"
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Update Password</h5>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input
                        type="password"
                        name="current_password"
                        id="current_password"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        required
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
