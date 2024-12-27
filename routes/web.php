<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::prefix('admin')->group(function () {
    // Trang đăng nhập
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');

    // Xử lý đăng nhập
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    // Các route cần bảo vệ bằng middleware auth
    Route::middleware(['Admin'])->group(function () {
        // Trang dashboard
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Đăng xuất
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/logout', function () {
            return view('admin.login');
        });
    });

    // Trang đăng ký
    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin.register.form');

    // Xử lý đăng ký
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
});
