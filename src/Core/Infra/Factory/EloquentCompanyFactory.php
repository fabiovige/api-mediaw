<?php

namespace Core\Infra\Factory;

use Core\Infra\Factory\CompanyFactoryInterface;
use Core\Domain\Entity\Company;
use App\Models\Company as CompanyModel;

class EloquentCompanyFactory implements CompanyFactoryInterface
{
    public function create(Company $company): Company
    {
        dd($company);
        //$companyModel = new CompanyModel(['name' => $name, 'cnpj' => $cnpj]);
        //$company = new Company($name, $cnpj);
        //return $company;
    }
}
