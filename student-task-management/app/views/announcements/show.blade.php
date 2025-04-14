@extends('appviews::master.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Announcement Details
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h3 class="text-lg font-medium">{{ $announcement->title }}</h3>
                    <p class="mt-1 text-sm text-gray-600">Scheduled for: {{ $announcement->scheduled_at->format('M d, Y H:i') }}</p>
                    <p class="mt-1 text-sm text-gray-600">Status:
                        @if($announcement->is_sent)
                            <span class="text-green-600">Sent</span>
                        @elseif($announcement->scheduled_at <= now())
                            <span class="text-yellow-600">Pending Send</span>
                        @else
                            <span class="text-blue-600">Scheduled</span>
                        @endif
                    </p>
                </div>

                <div class="mb-6">
                    <img src="{{ Storage::url($announcement->resized_image_path) }}" alt="Announcement Image" class="max-w-full h-auto rounded-lg">
                </div>

                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-900">Description</h4>
                    <p class="mt-1 text-sm text-gray-600 whitespace-pre-line">{{ $announcement->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
