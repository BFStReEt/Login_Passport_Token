<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\AdminController;

Route::group(['prefix' => 'member'], function () {
    Route::post('login', [MemberController::class, 'login']);
    Route::post('register', [MemberController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('member', [MemberController::class, 'member']);
        Route::post('logout', [MemberController::class, 'logout']);
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [AdminController::class, 'login']);
    Route::post('register', [AdminController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('admin', [AdminController::class, 'admin']);
        Route::post('logout', [AdminController::class, 'logout']);
    });
});
