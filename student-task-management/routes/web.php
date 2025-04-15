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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/generate', function () {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return 'successfully.';
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Dashboard & Profile
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/password', [ProfileController::class, 'password'])->name('profile.password');
    });

    // Tasks - accessible by all roles, control with policies or permission checks
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index'); // Teachers, Headmasters
    Route::post('tasks/{task}/approve', [TaskController::class, 'approve'])->name('tasks.approve');
    Route::resource('tasks', TaskController::class); 
    
    Route::post('/tasks/{task}/feedback', [TaskController::class, 'giveFeedback'])->name('tasks.feedback');
    Route::prefix('student/tasks')->middleware('role:student')->group(function () {
        Route::get('/', [TaskController::class, 'studentIndex'])->name('tasks.student.index');
        Route::get('/{task}', [TaskController::class, 'studentShow'])->name('student.tasks.show');
        Route::post('/{task}/submit', [TaskController::class, 'submit'])->name('student.tasks.submit');
    });

    // Teacher & Headmaster manage students
    Route::resource('students', StudentController::class);
    Route::post('students/{student}/request-delete', [StudentController::class, 'requestDelete'])->name('students.request-delete');
    Route::get('students/approve/{student}', [StudentController::class, 'approveDelete'])
    ->name('students.approve-delete');
    // Headmaster only
    Route::middleware('role:headmaster')->group(function () {
        Route::resource('teachers', TeacherController::class)->only(['index', 'create', 'store']);
        Route::resource('announcements', AnnouncementController::class);
    });

    // Student Announcements
    Route::get('announcements-student', [AnnouncementController::class, 'studentIndex'])->middleware('role:student')->name('announcements.student.index');
});

