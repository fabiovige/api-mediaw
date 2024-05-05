<?php

namespace Core\Infra\Factory;

use Core\Infra\Factory\CompanyFactoryInterface;
use Core\Domain\Entity\Company;

use App\Models\DoctrineCompany; // Este seria um modelo Doctrine.

class DoctrineCompanyFactory implements CompanyFactoryInterface
{
    public function create(Company $company): Company
    {
        // Exemplo hipotético de como você pode usar o Doctrine para criar uma entidade.
        $companyEntity = new Company(
            company: 'teste',
            cnpj: '123'
        );

        return $companyEntity;
    }
}
