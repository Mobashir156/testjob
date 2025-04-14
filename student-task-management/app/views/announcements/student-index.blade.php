@extends('appviews::master.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Announcements
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="space-y-6">
            @forelse($announcements as $announcement)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-medium">{{ $announcement->title }}</h3>
                            <span class="text-sm text-gray-500">{{ $announcement->scheduled_at->format('M d, Y') }}</span>
                        </div>

                        @if($announcement->resized_image_path)
                            <div class="my-4">
                                <img src="{{ Storage::url($announcement->resized_image_path) }}" alt="Announcement Image" class="max-w-full h-auto rounded-lg">
                            </div>
                        @endif

                        <div class="mt-2 text-sm text-gray-600 whitespace-pre-line">{{ $announcement->description }}</div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center text-gray-500">
                        No announcements available
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
