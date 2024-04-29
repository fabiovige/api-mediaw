<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    protected Company $model;

    public function __construct()
    {
        $this->model = app(Company::class);
    }

    public function getByCnpj($cnpj)
    {
        return $this->model::where('cnpj', '=', $cnpj )->first();
    }
}