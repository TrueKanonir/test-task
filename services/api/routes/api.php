<?php

use Illuminate\Support\Facades\Route;
use App\Http\Api\V1\Auth\LoginController;
use App\Http\Api\V1\Auth\PasswordResetController;
use App\Http\Api\V1\Auth\UpdatePasswordController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class);

        Route::post('password/reset', PasswordResetController::class);
        Route::post('password/update', UpdatePasswordController::class);
    });
});
