@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">Task Details</h2>
@endsection

@section('content')
<div class="py-4">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="mb-1">Assigned to: <strong>{{ $task->student->user->name }}</strong></p>
                    <p>
                        Status:
                        @if($task->approved_at)
                            <span class="badge bg-success">Approved</span> on {{ $task->approved_at }}
                        @else
                            <span class="badge bg-warning text-dark">Pending Approval</span>
                        @endif
                    </p>
                </div>

                <div class="mb-4">
                    <h6>Description</h6>
                    <p class="text-muted" style="white-space: pre-line;">{{ $task->description }}</p>
                </div>

                @if($task->submission)
                    <div class="alert alert-secondary">
                        <h6>Student Submission</h6>
                        <p class="mb-1" style="white-space: pre-line;">{{ $task->submission->notes }}</p>

                        @if($task->submission->file_path)
                            <a href="{{ Storage::url($task->submission->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-download"></i> Download Submitted File
                            </a>
                        @endif
                    </div>
                @endif

                @if($task->submission && $task->submission->feedback)
                    <div class="alert alert-info">
                        <h6>Teacher Feedback</h6>
                        <p class="mb-1" style="white-space: pre-line;">{{ $task->submission->feedback }}</p>
                        <small class="text-muted">Provided by: {{ $task->submission->feedbackProvider->name }} on {{ $task->submission->feedback_at->format('M d, Y') }}</small>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('tasks.submit'))
                    @if (!$task->submission)
                        <div class="mt-4">
                            <h6>Submit Your Work</h6>
                            <form method="POST" action="{{ route('student.tasks.submit', $task) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">File (optional)</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Task</button>
                            </form>
                        </div>
                    @endif
                @endif


                @if (auth()->user()->hasPermission('tasks.give_feedback'))
                    @if ($task->submission && !$task->submission->feedback)
                        <div class="mt-4">
                            <h6>Provide Feedback</h6>
                            <form method="POST" action="{{ route('tasks.feedback', $task) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="feedback" class="form-label">Feedback</label>
                                    <textarea name="feedback" id="feedback" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Submit Feedback</button>
                            </form>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
