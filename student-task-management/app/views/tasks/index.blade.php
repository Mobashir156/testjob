@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">Tasks</h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Task List</h5>
                @if (auth()->user()->hasPermission('tasks.create'))
                <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
                    Create Task
                </a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Student</th>
                            <th>Status</th>
                            <th>Submission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->student->user->name }}</td>
                                <td>
                                    @if($task->approved_at)
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($task->submission)
                                        <span class="badge bg-primary">Submitted</span>
                                    @else
                                        <span class="badge bg-secondary">Not Submitted</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-link btn-sm text-decoration-none text-primary">View</a>
                                    @can('approve', $task)
                                        @if(!$task->approved_at)
                                            <form action="{{ route('tasks.approve', $task) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link btn-sm text-success p-0">Approve</button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No tasks found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
