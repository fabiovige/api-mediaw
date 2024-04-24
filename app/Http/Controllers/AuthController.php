<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAuthentication;
use App\Services\AuthServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AuthController extends Controller
{

    public function __construct(private AuthServices $authService)
    {
    }

    public function login(Request $request)
    {
        try {
            $token = $this->authService->getToken($request->token_api_service);

            return response()->json([
                'data' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL()
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

    public function payloadToken()
    {
        $payload = auth()->payload();
        $id_company = $payload->get('sub');
        $user = auth()->user();
        dd($user, $user->company,  $user->company->company_gateways);
        dd($payload);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.'], 200);
    }
}
