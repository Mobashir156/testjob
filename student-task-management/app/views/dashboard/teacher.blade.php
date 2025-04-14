@extends('appviews::master.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Teacher Dashboard</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">My Students</h5>
                            <h2 class="mb-0">{{ $studentCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Active Tasks</h5>
                            <h2 class="mb-0">{{ $activeTaskCount }}</h2>
                        </div>
                        <i class="fas fa-tasks fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Pending Approval</h5>
                            <h2 class="mb-0">{{ $pendingTaskCount }}</h2>
                        </div>
                        <i class="fas fa-clock fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex">
                <a href="{{ route('students.create') }}" class="btn btn-primary me-md-2">
                    <i class="fas fa-user-plus me-1"></i> Add Student
                </a>
                <a href="{{ route('tasks.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Create Task
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
