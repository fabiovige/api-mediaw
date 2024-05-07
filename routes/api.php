<?php

use App\Http\Controllers\Api\V1\Company\IndexController;
use App\Http\Controllers\Api\V1\Company\StoreController;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/companies', StoreController::class)->name('store');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/company-authentication', [AuthController::class, 'getTokenApiService']);

Route::middleware('auth:api')->group(function () {
    // mediaw
    Route::get('/companies', IndexController::class)->name('index');
    Route::get('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/payload-token', [AuthController::class, 'payloadToken']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // pagarme
    Route::get('/service-orders-list', [PaymentController::class, 'listOrders']);
    Route::post('/service-orders-create', [PaymentController::class, 'createOrder']);
    Route::post('/service-order', [PaymentController::class, 'getOrder']);
    Route::patch('/service-order-close/{order_id}', [PaymentController::class, 'closeOrder']);
    Route::post('/service-order-item', [PaymentController::class, 'getItemOrder']);
    Route::post('/service-order-add-item/{order_id}', [PaymentController::class, 'addItemOrder']);
});


// refatorado
Route::post('/create-company', [CompanyController::class, 'store']);
Route::post('/filter-company', [CompanyController::class, 'filter']);


