<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

// Login routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student routes
Route::get('/welcome', [StudentController::class, 'index'])->name('welcome'); // Use StudentController
Route::post('/save-student', [StudentController::class, 'store']);