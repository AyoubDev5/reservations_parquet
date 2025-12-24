<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Livewire\ReservationIndex;
use Illuminate\Support\Facades\Route;




Route::middleware('guest')->group(function () {
   Route::get('/login', function () {
        return view('login'); // resources/views/login.blade.php
    })->name('login');

    // معالجة تسجيل الدخول
    Route::post('/login', [LoginController::class, 'login']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.edit');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.delete');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// require __DIR__.'/auth.php';
