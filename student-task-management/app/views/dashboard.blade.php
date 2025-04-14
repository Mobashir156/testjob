@extends('appviews::master.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if(auth()->user()->isHeadmaster())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-800">Teachers</h3>
                            <p class="mt-2 text-3xl font-bold text-blue-600">{{ App\Models\User::where('role', 'teacher')->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-800">Students</h3>
                            <p class="mt-2 text-3xl font-bold text-green-600">{{ App\Models\Student::count() }}</p>
                        </div>
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-800">Pending Tasks</h3>
                            <p class="mt-2 text-3xl font-bold text-purple-600">{{ App\Models\Task::whereNull('approved_at')->count() }}</p>
                        </div>
                    </div>
                @elseif(auth()->user()->isTeacher())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-800">My Students</h3>
                            <p class="mt-2 text-3xl font-bold text-green-600">{{ auth()->user()->students()->count() }}</p>
                        </div>
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-800">Active Tasks</h3>
                            <p class="mt-2 text-3xl font-bold text-blue-600">{{ auth()->user()->tasks()->whereNotNull('approved_at')->count() }}</p>
                        </div>
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-800">Pending Approval</h3>
                            <p class="mt-2 text-3xl font-bold text-purple-600">{{ auth()->user()->tasks()->whereNull('approved_at')->count() }}</p>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-800">Assigned Tasks</h3>
                            <p class="mt-2 text-3xl font-bold text-blue-600">{{ auth()->user()->assignedTasks()->whereNotNull('approved_at')->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-800">Completed Tasks</h3>
                            <p class="mt-2 text-3xl font-bold text-green-600">{{ auth()->user()->assignedTasks()->whereNotNull('approved_at')->has('submission')->count() }}</p>
                        </div>
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-800">Pending Feedback</h3>
                            <p class="mt-2 text-3xl font-bold text-purple-600">{{ auth()->user()->assignedTasks()->whereNotNull('approved_at')->whereHas('submission', function($q) {
                                $q->whereNull('feedback');
                            })->count() }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
