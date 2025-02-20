<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;

// Login routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/siswa', [StudentController::class, 'index'])->name('siswa.index');
    Route::post('/save-student', [StudentController::class, 'store']);
    Route::get('/get-student/{id}', [StudentController::class, 'show']);
    Route::put('/update-student/{id}', [StudentController::class, 'update']);
});

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

