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
        // Store original image
        $originalPath = $request->file('image')->store('public/announcements/original');
        $originalPublicPath = str_replace('public/', '', $originalPath); // Path for DB
        $sourcePath = Storage::path($originalPath);

        // Load image using GD
        $extension = strtolower($request->file('image')->getClientOriginalExtension());
        $srcImage = match ($extension) {
            'jpeg', 'jpg' => imagecreatefromjpeg($sourcePath),
            'png'         => imagecreatefrompng($sourcePath),
            'gif'         => imagecreatefromgif($sourcePath),
            default       => abort(415, 'Unsupported image format.'),
        };

        // Resize
        $newWidth = 800;
        $newHeight = intval((imagesy($srcImage) / imagesx($srcImage)) * $newWidth);
        $resizedImage = imagescale($srcImage, $newWidth, $newHeight);
        if ($resizedImage === false) {
            imagedestroy($srcImage);
            abort(500, 'Failed to resize image.');
        }
        $resizedFilename = 'public/announcements/resized/' . Str::uuid() . '.webp';
        $resizedPath = Storage::path($resizedFilename);
        Storage::makeDirectory(dirname($resizedFilename)); // Ensure directory exists
        imagewebp($resizedImage, $resizedPath, 75);

        imagedestroy($srcImage);
        imagedestroy($resizedImage);

        Announcement::create([
            'headmaster_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'original_image_path' => $originalPublicPath,
            'resized_image_path' => str_replace('public/', '', $resizedFilename),
            'scheduled_at' => $request->scheduled_at,
        ]);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully.');
    }


    public function show(Announcement $announcement)
    {
       return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
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
