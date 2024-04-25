<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/companies', \App\Http\Controllers\Api\V1\Company\StoreController::class)->name('store');

Route::middleware('auth:api')->group(function () {
    Route::get('/companies', \App\Http\Controllers\Api\V1\Company\IndexController::class)->name('index');
    Route::get('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/payload-token', [AuthController::class, 'payloadToken']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // endpoints
    Route::get('/service-orders-list', [PaymentController::class, 'listOrders']);
    Route::post('/service-orders-create', [PaymentController::class, 'createOrder']);
    Route::get('/service-order/{order_id}', [PaymentController::class, 'getOrder']);
    Route::patch('/service-order-close/{order_id}', [PaymentController::class, 'closeOrder']);
    //Route::get('/service-order-item', [PaymentController::class, 'getItemOrder']);
    //Route::post('/service-order-add-item', [PaymentController::class, 'addItemOrder']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/company-authentication', [AuthController::class, 'getTokenApiService']);

