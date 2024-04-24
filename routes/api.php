<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/companies', \App\Http\Controllers\Api\V1\Company\IndexController::class)->name('index');
    Route::post('/companies', \App\Http\Controllers\Api\V1\Company\StoreController::class)->name('store');

    Route::get('/refresh-token', [AuthController::class, 'refreshToken'])->middleware('auth:api');
    Route::get('/payload-token', [AuthController::class, 'payloadToken'])->middleware('auth:api');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/company-authentication', [AuthController::class, 'getTokenApiService']);

