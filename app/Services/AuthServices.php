<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyAuthentication;
use Illuminate\Http\Request;

class AuthServices
{
    public function getToken(string $token_api_service): String
    {
        $companyAuthentication = CompanyAuthentication::where('token_api_service', '=', $token_api_service )->first();
        if (!$companyAuthentication){
            throw new \Exception('Token inválido');
        }

        $credentials = [
            'email' => $companyAuthentication->company->user->email,
            'password' => $token_api_service
        ];

        $token = auth()->attempt($credentials);

        return $token;
    }

    public function getTokenApiService(string $cnpj): string
    {
        $company = Company::where('cnpj', '=', $cnpj )->first();
        if(!$company){
            throw new \Exception('Cnpj não encontrado');
        }

        return $company->company_authentication->token_api_service;
    }

    public function refreshToken(): string
    {
        $token = \Illuminate\Support\Facades\Auth::refresh();
        return $token;
    }

    public function logout(): void
    {
        auth()->logout(true);
    }
}
