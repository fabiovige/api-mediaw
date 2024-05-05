<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\Company as CompanyEntity;
use Core\Domain\Factory\CompanyFactoryInterface;
use Core\Domain\Repositories\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(
        private CompanyFactoryInterface $factory
    ){}

    public function save(CompanyEntity $companyEntity): CompanyEntity
    {
        $company = $this->factory->create($companyEntity);
        dd($company);
        // Aqui, o modelo Eloquent é salvo pelo método create da factory
        return $company;
    }
}
