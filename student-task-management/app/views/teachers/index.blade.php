@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">
        Teachers
    </h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">All Teachers</h5>
                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
                    Add Teacher
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone ?? 'N/A' }}</td>
                                <td>{{ $teacher->students()->count() }}</td>
                                <td>
                                    <a href="#" class="btn btn-link btn-sm text-primary">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No teachers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
