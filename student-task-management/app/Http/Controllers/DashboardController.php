<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return view('appviews::dashboard.student', [
                'assignedTaskCount' => $user->assignedTasks()->whereNotNull('approved_at')->count(),
                'completedTaskCount' => $user->assignedTasks()->whereNotNull('approved_at')->has('submission')->count(),
                'pendingFeedbackCount' => $user->assignedTasks()
                    ->whereNotNull('approved_at')
                    ->whereHas('submission', function($q) {
                        $q->whereNull('feedback');
                    })->count(),
            ]);
        }

        return redirect()->route('login');
    }
}
