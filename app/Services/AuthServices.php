<?php

namespace App\Services;

use App\Repositories\CompanyAuthenticationRepository;
use App\Repositories\CompanyRepository;

class AuthServices
{
    protected CompanyRepository $companyRepository;
    protected CompanyAuthenticationRepository $companyAuthenticationRepository;

    public function __construct()
    {
        $this->companyRepository = app(CompanyRepository::class);
        $this->companyAuthenticationRepository = app(CompanyAuthenticationRepository::class);
    }

    public function getToken(string $token_api_service): String
    {
        $companyAuthentication = $this->companyAuthenticationRepository->getTokenApiService($token_api_service);
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
        $company = $this->companyRepository->getByCnpj($cnpj);
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
