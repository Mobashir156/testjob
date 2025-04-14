<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Headmaster Routes
    Route::middleware('can:createTeacher,App\Models\User')->group(function () {
        Route::resource('teachers', TeacherController::class)->only(['index', 'create', 'store']);
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::post('tasks/{task}/approve', [TaskController::class, 'approve'])->name('tasks.approve');
        Route::resource('announcements', AnnouncementController::class);
    });

    // Teacher Routes
    Route::middleware('can:createStudent,App\Models\User')->group(function () {
        Route::resource('students', StudentController::class)->except(['index']);
        Route::post('students/{student}/request-delete', [StudentController::class, 'requestDelete'])->name('students.request-delete');
        Route::resource('tasks', TaskController::class);
    });

    // Student Routes
    Route::middleware('role:student')->group(function () {
        Route::get('my-tasks', [TaskController::class, 'studentIndex'])->name('tasks.student.index');
        Route::get('tasks/{task}', [TaskController::class, 'studentShow'])->name('tasks.student.show');
        Route::post('tasks/{task}/submit', [TaskController::class, 'submit'])->name('tasks.submit');
        Route::get('announcements/student', [AnnouncementController::class, 'studentIndex'])->name('announcements.student.index');
    });
});
