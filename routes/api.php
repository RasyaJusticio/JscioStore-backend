<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
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

    Route::group(['middleware' => ['auth:sanctum', 'admin-only'], 'prefix' => 'dashboard'], function () {
        Route::apiResource('category', AdminCategoryController::class);
        Route::apiResource('product', AdminProductController::class);
    });
});
