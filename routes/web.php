<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {
    // Trang đăng nhập
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware(['admin'])->group(function () {
        // Trang dashboard
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin');

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
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
});
