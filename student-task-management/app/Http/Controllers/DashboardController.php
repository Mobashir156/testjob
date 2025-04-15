<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isHeadmaster()) {
            return view('appviews::dashboard.headmaster', [
                'teacherCount' => \App\Models\User::where('role', 'teacher')->count(),
                'studentCount' => \App\Models\Student::count(),
                'pendingTaskCount' => \App\Models\Task::whereNull('approved_at')->count(),
            ]);
        }

        if ($user->isTeacher()) {
            return view('appviews::dashboard.teacher', [
                'studentCount' => $user->students()->count(),
                'activeTaskCount' => $user->tasks()->whereNotNull('approved_at')->count(),
                'pendingTaskCount' => $user->tasks()->whereNull('approved_at')->count(),
            ]);
        }

        if ($user->isStudent()) {
            $student = Student::where('user_id', $user->id)->first();
            return view('appviews::dashboard.student', [
                'assignedTaskCount' => $student->assignedTasks()->whereNotNull('approved_at')->count(),
                'completedTaskCount' => $student->assignedTasks()->whereNotNull('approved_at')->has('submission')->count(),
                'pendingFeedbackCount' => $student->assignedTasks()
                    ->whereNotNull('approved_at')
                    ->whereHas('submission', function($q) {
                        $q->whereNull('feedback');
                    })->count(),
                'tasks' => $student->assignedTasks()->whereNotNull('approved_at')->latest()->take(3)->get(),
                'notice' => Announcement::where('scheduled_at', '<=', now())
                            ->where('is_sent', true)
                            ->latest()
                            ->take(3)
                            ->get(),
            ]);
        }

        return redirect()->route('login');
    }
}
