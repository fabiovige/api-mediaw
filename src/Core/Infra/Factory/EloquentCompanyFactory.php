<?php

namespace Core\Infra\Factory;

use Core\Domain\Factory\CompanyFactoryInterface;
use Core\Domain\Entity\Company;
use App\Models\Company as CompanyModel;

class EloquentCompanyFactory implements CompanyFactoryInterface
{
    public function create(string $name, string $cnpj): Company
    {
        $companyModel = new CompanyModel(['name' => $name, 'cnpj' => $cnpj]);
        $company = new Company($name, $cnpj);
        $company->setId($companyModel->id);
        return $company;
    }
}
