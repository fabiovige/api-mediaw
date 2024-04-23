<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/companies', \App\Http\Controllers\Api\V1\Company\IndexController::class)->name('index');
    Route::post('/companies', \App\Http\Controllers\Api\V1\Company\StoreController::class)->name('store');
});

Route::post('/login', function(Request $request) {

    $credentials = $request->only('email', 'password');

    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]
    ]);
});


Route::post('/refresh', function(Request $request) {

    $token = \Illuminate\Support\Facades\Auth::refresh();

    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]
    ]);
})->middleware('auth:api');

