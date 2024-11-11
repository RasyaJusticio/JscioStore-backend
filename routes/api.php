<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProductImageController;
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

        Route::group(['prefix' => 'product'], function () {
            Route::apiResource('', AdminProductController::class);
            Route::group(['prefix' => '{product}'], function () {
                Route::group(['prefix' => 'category'], function () {
                    Route::post('attach', [AdminProductCategoryController::class, 'store']);
                    Route::post('detach', [AdminProductCategoryController::class, 'destroy']);
                });

                Route::group(['prefix' => 'images'], function () {
                    Route::get('', [AdminProductImageController::class, 'index']);
                });
            });
        });
    });
});
