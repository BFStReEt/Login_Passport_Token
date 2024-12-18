<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\AdminController;

Route::group(['prefix' => 'member'], function () {
    Route::post('login', [MemberController::class, 'login']);
    Route::post('register', [MemberController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [MemberController::class, 'user']);
        Route::post('logout', [MemberController::class, 'logout']);
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [MemberController::class, 'login']);
    Route::post('register', [MemberController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [MemberController::class, 'user']);
        Route::post('logout', [MemberController::class, 'logout']);
    });
});
