<?php

namespace Core\Infra\Factory;

use Core\Domain\Entity\Company;

use App\Models\DoctrineCompany; // Este seria um modelo Doctrine.
use Core\Domain\Persistence\CompanyOrmInterface;

class DoctrineCompanyFactory implements CompanyOrmInterface
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
