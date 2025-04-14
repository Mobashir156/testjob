@extends('appviews::master.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Task Details
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h3 class="text-lg font-medium">{{ $task->title }}</h3>
                    <p class="mt-2 text-sm text-gray-600">Assigned to: {{ $task->student->user->name }}</p>
                    <p class="mt-1 text-sm text-gray-600">Status:
                        @if($task->approved_at)
                            <span class="text-green-600">Approved</span> on {{ $task->approved_at->format('M d, Y') }}
                        @else
                            <span class="text-yellow-600">Pending Approval</span>
                        @endif
                    </p>
                </div>

                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-900">Description</h4>
                    <p class="mt-1 text-sm text-gray-600 whitespace-pre-line">{{ $task->description }}</p>
                </div>

                @if($task->submission)
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-md font-medium text-gray-900">Student Submission</h4>
                        <p class="mt-1 text-sm text-gray-600 whitespace-pre-line">{{ $task->submission->notes }}</p>

                        @if($task->submission->file_path)
                            <div class="mt-2">
                                <a href="{{ Storage::url($task->submission->file_path) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-900">
                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                    Download Submitted File
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if($task->submission && $task->submission->feedback)
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-md font-medium text-gray-900">Teacher Feedback</h4>
                        <p class="mt-1 text-sm text-gray-600 whitespace-pre-line">{{ $task->submission->feedback }}</p>
                        <p class="mt-1 text-xs text-gray-500">Provided by: {{ $task->submission->feedbackProvider->name }} on {{ $task->submission->feedback_at->format('M d, Y') }}</p>
                    </div>
                @endif

                @can('submit', $task)
                    @if(!$task->submission)
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-900 mb-2">Submit Your Work</h4>
                            <form method="POST" action="{{ route('tasks.submit', $task) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="file" class="block text-sm font-medium text-gray-700">File (Optional)</label>
                                    <input type="file" name="file" id="file" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Submit Task
                                </button>
                            </form>
                        </div>
                    @endif
                @endcan

                @can('giveFeedback', $task)
                    @if($task->submission && !$task->submission->feedback)
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-900 mb-2">Provide Feedback</h4>
                            <form method="POST" action="{{ route('tasks.feedback', $task) }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
                                    <textarea name="feedback" id="feedback" rows="3" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Submit Feedback
                                </button>
                            </form>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
