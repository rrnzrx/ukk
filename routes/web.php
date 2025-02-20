<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('siswa', StudentController::class);

// Route::get('/siswa', [StudentController::class, 'index'])->name('siswa.index');
// Route::get('/siswa/{id}/edit', [StudentController::class, 'edit'])->name('siswa.edit');
// Route::post('/students', [StudentController::class, 'store'])->name('students.store');
// Route::post('/save-student', [StudentController::class, 'store']);
// Route::get('/get-student/{id}', [StudentController::class, 'show']);
// Route::put('/update-student/{id}', [StudentController::class, 'update']);
// Route::delete('/delete-student/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
