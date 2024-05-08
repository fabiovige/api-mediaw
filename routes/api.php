<?php

use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PaymentController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/company-authentication', [AuthController::class, 'getTokenApiService']);

Route::middleware('auth:api')->group(function () {
    // mediaw
    Route::get('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // pagarme
    Route::get('/service-orders-list', [PaymentController::class, 'listOrders']);
    Route::post('/service-orders-create', [PaymentController::class, 'createOrder']);
    Route::post('/service-order', [PaymentController::class, 'getOrder']);
    Route::patch('/service-order-close/{order_id}', [PaymentController::class, 'closeOrder']);
    Route::post('/service-order-item', [PaymentController::class, 'getItemOrder']);
    Route::post('/service-order-add-item/{order_id}', [PaymentController::class, 'addItemOrder']);

    // create order com split - deixei o endpoint separado para facilitar os testes
    Route::post('/service-orders-create-split', [PaymentController::class, 'createOrder']);
});

// refatorado
Route::post('/create-company', [CompanyController::class, 'store']);
Route::post('/companies', [CompanyController::class, 'filter']);
