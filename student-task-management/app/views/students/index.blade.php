@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">
        @if(auth()->user()->isHeadmaster())
            All Students
        @else
            My Students
        @endif
    </h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            @can('createStudent', App\Models\User::class)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Student List</h5>
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                        Add Student
                    </a>
                </div>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            @if(auth()->user()->isHeadmaster())
                                <th>Teacher</th>
                            @endif
                            <th>Tasks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->user->phone ?? 'N/A' }}</td>
                                @if(auth()->user()->isHeadmaster())
                                    <td>{{ $student->teacher->name }}</td>
                                @endif
                                <td>{{ $student->tasks()->count() }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-link btn-sm text-primary me-2">View</a>
                                    @can('requestDelete', $student)
                                        <form action="{{ route('students.request-delete', $student) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link btn-sm text-danger">Request Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isHeadmaster() ? 6 : 5 }}" class="text-center text-muted">
                                    No students found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
