@extends('appviews::master.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Student Dashboard</h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Assigned Tasks</h5>
                            <h2 class="mb-0">{{ $assignedTaskCount }}</h2>
                        </div>
                        <i class="fas fa-tasks fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Completed Tasks</h5>
                            <h2 class="mb-0">{{ $completedTaskCount }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Pending Feedback</h5>
                            <h2 class="mb-0">{{ $pendingFeedbackCount }}</h2>
                        </div>
                        <i class="fas fa-comments fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Tasks -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Upcoming Tasks</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->assignedTasks()->whereNotNull('approved_at')->latest()->take(3)->get() as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}</td>
                            <td>
                                @if($task->submission)
                                    <span class="badge bg-success">Submitted</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.student.show', $task) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
