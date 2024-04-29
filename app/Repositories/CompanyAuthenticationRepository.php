<?php

namespace App\Repositories;

use App\Models\CompanyAuthentication;

class CompanyAuthenticationRepository
{
    protected CompanyAuthentication $model;

    public function __construct()
    {
        $this->model = app(CompanyAuthentication::class);
    }

    public function getTokenApiService($token_api_service)
    {
        return $this->model::where('token_api_service', '=', $token_api_service )->first();
    }
}