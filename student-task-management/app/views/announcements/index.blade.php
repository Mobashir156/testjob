@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">Announcements</h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Announcement List</h5>
                <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-sm">
                    Create Announcement
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Scheduled For</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ $announcement->scheduled_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($announcement->is_sent)
                                        <span class="badge bg-success">Sent</span>
                                    @elseif($announcement->scheduled_at <= now())
                                        <span class="badge bg-warning text-dark">Pending Send</span>
                                    @else
                                        <span class="badge bg-primary">Scheduled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-link btn-sm text-primary">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No announcements found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
