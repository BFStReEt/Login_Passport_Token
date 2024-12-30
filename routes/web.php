<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Kernel;

Route::prefix('admin')->group(function () {
    // Trang đăng nhập
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin-login.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin-login');

    Route::middleware(['admin'])->group(function () {
        // Trang dashboard
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin-dashboard');

        // Đăng xuất
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    });

    // Trang đăng ký
    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin-register.form');

    Route::post('/register', [AdminController::class, 'register'])->name('admin-register');
});
