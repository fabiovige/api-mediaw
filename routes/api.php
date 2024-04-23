<?php

use App\Http\Controllers\Api\V1\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::apiResource('companies', CompanyController::class);

Route::prefix('companies')->as('companies:')->group(function () {
    Route::get('/', \App\Http\Controllers\Api\V1\Company\IndexController::class, 'index');
});
