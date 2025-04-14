<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('headmaster_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scheduled_at' => 'required|date|after:now',
        ]);

        $originalPath = $request->file('image')->store('announcements/original');
        $resizedPath = 'announcements/resized/'.Str::uuid().'.webp';

        $image = Image::make(storage_path('app/'.$originalPath))
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('webp', 75)
            ->save(storage_path('app/'.$resizedPath));

        Announcement::create([
            'headmaster_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'original_image_path' => $originalPath,
            'resized_image_path' => $resizedPath,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function show(Announcement $announcement)
    {
        $this->authorize('view', $announcement);

        return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scheduled_at' => 'required|date',
        ]);

        $originalPath = $announcement->original_image_path;
        $resizedPath = $announcement->resized_image_path;

        if ($request->file('image')) {
            Storage::delete([$originalPath, $resizedPath]);

            $originalPath = $request->file('image')->store('announcements/original');
            $resizedPath = 'announcements/resized/'.Str::uuid().'.webp';

            Image::make(storage_path('app/'.$originalPath))
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('webp', 75)
                ->save(storage_path('app/'.$resizedPath));
        }

        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'original_image_path' => $originalPath,
            'resized_image_path' => $resizedPath,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        Storage::delete([$announcement->original_image_path, $announcement->resized_image_path]);
        $announcement->delete();

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }

    public function studentIndex()
    {
        $announcements = Announcement::where('scheduled_at', '<=', now())
            ->where('is_sent', true)
            ->latest()
            ->paginate(10);

        return view('announcements.student-index', compact('announcements'));
    }
}
