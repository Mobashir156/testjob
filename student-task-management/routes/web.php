<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::prefix('headmaster')
    ->middleware(['auth', 'headmaster'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('headmaster.dashboard');
        })->name('headmaster.dashboard');
    });

Route::prefix('teacher')
    ->middleware(['auth', 'teacher'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');
    });

Route::prefix('student')
    ->middleware(['auth', 'student'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });
