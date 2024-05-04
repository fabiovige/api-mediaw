<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\Company;
use Core\Domain\Factory\CompanyFactoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{

    private $factory;

    public function __construct(CompanyFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function save(Company $company): Company
    {
        $company = $this->factory->create(
            $company->company,
            $company->cnpj
        );
        // Aqui, o modelo Eloquent é salvo pelo método create da factory
        return $company;
    }
}
