<?php

use App\Models\Company;
use App\Models\CompanyAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::middleware('auth:api')->group(function () {
    Route::get('/companies', \App\Http\Controllers\Api\V1\Company\IndexController::class)->name('index');
    Route::post('/companies', \App\Http\Controllers\Api\V1\Company\StoreController::class)->name('store');
});

Route::post('/login', function(Request $request) {

    $token_api_service = $request->token_api_service;

    $companyAuthentication = CompanyAuthentication::where('token_api_service', '=', $token_api_service )->first();
    if (!$companyAuthentication){
        return response()->json(['error' => 'Token Api Service inválido'], 401);
    }

    $credentials = [
        'email' => $companyAuthentication->company->user->email,
        'password' => $token_api_service
    ];

    $token = auth()->attempt($credentials);

    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]
    ]);
});

Route::get('/company-authentication', function(Request $request) {

    $cnpj = $request->cnpj;

    $company = Company::where('cnpj', '=', $cnpj )->first();
    if(!$company){
        return response()->json(['error' => 'Company não encontrado!'], 401);
    }

    $token_api_service = $company->company_authentication->token_api_service;

    return response()->json([
        'data' => [
            'token_api_service' => $token_api_service,
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

Route::get('/payload', function(Request $request) {

    $payload = auth()->payload();
    $id_company = $payload->get('sub');
    $user = auth()->user();
    dd($user, $user->company,  $user->company->company_gateways);
    dd($payload);

})->middleware('auth:api');


Route::get('/logout', function(Request $request) {
    auth()->logout(true);
    return response()->json(['message' => 'Logout realizado com sucesso.']);
})->middleware('auth:api');




