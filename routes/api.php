<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserShipAddressController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
    });

    Route::apiResource('ship-address', UserShipAddressController::class)->middleware(['auth:sanctum']);
});
