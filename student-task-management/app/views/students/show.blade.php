@extends('appviews::master.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Details
    </h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container mx-auto px-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Student Information</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $student->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $student->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $student->user->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Roll No</th>
                        <td>{{ $student->roll_number }}</td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td>{{ $student->class ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Section</th>
                        <td>{{ $student->section ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Registered At</th>
                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
                    @can('update', $student)
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
