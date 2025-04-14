<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['student.user', 'teacher', 'approver'])
            ->when(auth()->user()->isTeacher(), function ($query) {
                return $query->where('teacher_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $students = Student::where('teacher_id', auth()->id())
            ->with('user')
            ->get();

        return view('tasks.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id,teacher_id,'.auth()->id(),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = $request->file('file')
            ? $request->file('file')->store('tasks')
            : null;

        Task::create([
            'teacher_id' => auth()->id(),
            'student_id' => $request->student_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'file_path' => $filePath,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $students = Student::where('teacher_id', auth()->id())
            ->with('user')
            ->get();

        return view('tasks.edit', compact('task', 'students'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'student_id' => 'required|exists:students,id,teacher_id,'.auth()->id(),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = $task->file_path;

        if ($request->file('file')) {
            if ($filePath) {
                Storage::delete($filePath);
            }
            $filePath = $request->file('file')->store('tasks');
        }

        $task->update([
            'student_id' => $request->student_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'file_path' => $filePath,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        if ($task->file_path) {
            Storage::delete($task->file_path);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    public function approve(Task $task)
    {
        $this->authorize('approve', $task);

        $task->update([
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Task approved successfully.');
    }

    public function studentIndex()
    {
        $tasks = auth()->user()->assignedTasks()
            ->whereNotNull('approved_at')
            ->with(['teacher', 'submission'])
            ->latest()
            ->paginate(10);

        return view('tasks.student-index', compact('tasks'));
    }

    public function studentShow(Task $task)
    {
        $this->authorize('viewAsStudent', $task);

        return view('tasks.student-show', compact('task'));
    }

    public function submit(Request $request, Task $task)
    {
        $this->authorize('submit', $task);

        $request->validate([
            'notes' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = $request->file('file')
            ? $request->file('file')->store('submissions')
            : null;

        $task->submission()->create([
            'notes' => $request->notes,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Task submitted successfully.');
    }

    public function giveFeedback(Request $request, Task $task)
    {
        $this->authorize('giveFeedback', $task);

        $request->validate([
            'feedback' => 'required|string',
        ]);

        $task->submission->update([
            'feedback' => $request->feedback,
            'feedback_by' => auth()->id(),
            'feedback_at' => now(),
        ]);

        return back()->with('success', 'Feedback submitted successfully.');
    }
}
