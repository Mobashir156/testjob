@extends('appviews::master.app')

@section('title', 'Headmaster Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Headmaster Dashboard</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Teachers</h5>
                            <h2 class="mb-0">{{ $teacherCount }}</h2>
                        </div>
                        <i class="fas fa-chalkboard-teacher fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Students</h5>
                            <h2 class="mb-0">{{ $studentCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Pending Tasks</h5>
                            <h2 class="mb-0">{{ $pendingTaskCount }}</h2>
                        </div>
                        <i class="fas fa-tasks fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Recent Activities</h5>
        </div>
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">New teacher registered</h6>
                        <small>3 days ago</small>
                    </div>
                    <p class="mb-1">John Doe joined as a new teacher</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Task approved</h6>
                        <small>1 week ago</small>
                    </div>
                    <p class="mb-1">Math assignment for Class 10</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
