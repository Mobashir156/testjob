@extends('appviews::master.app')

@section('header')
    <h2 class="h4 mb-4">Create New Announcement</h2>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('announcements.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control"
                        required
                    ></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="scheduled_at" class="form-label">Schedule Date & Time</label>
                    <input
                        type="datetime-local"
                        name="scheduled_at"
                        id="scheduled_at"
                        class="form-control"
                        required
                        min="{{ now()->format('Y-m-d\TH:i') }}"
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Schedule Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
