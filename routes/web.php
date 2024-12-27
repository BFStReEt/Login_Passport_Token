<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login.form');

    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');



    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin.register.form');

    Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
});
