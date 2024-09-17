<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user/counter', [UserController::class, 'counterAccount']);

        Route::get('/fetch-user', [AuthController::class, 'getUserByToken']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
