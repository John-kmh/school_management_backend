<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Frontend\UserController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile/update', [AuthController::class, 'updateProfile']);
    Route::post('profile/reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('role:Superadmin')->group(function () {
        Route::post('users', [UserController::class, 'store']); // create new user
    });
});
