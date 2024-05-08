<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Core\Application\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService  $authService){}

    public function login(Request $request)
    {
        try {
            $token = $this->authService->getToken($request->token_api_service);

            return response()->json([
                'data' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                ]
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                'data' => [
                    'error' =>  $e->getMessage(),
                ]
            ], 404);
        }
    }

    public function getTokenApiService(Request $request)
    {
        try {
            $cnpj = $request->cnpj;

            $token_api_service = $this->authService->getTokenApiService($cnpj);

            return response()->json([
                'data' => [
                    'token_api_service' => $token_api_service,
                ]
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'data' => [
                    'error' =>  $e->getMessage(),
                ]
            ], 404);
        }
    }

    public function refreshToken()
    {
        return response()->json([
            'data' => [
                'token' => $this->authService->refreshToken(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL()
            ]
        ], 200);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.'], 200);
    }
}
