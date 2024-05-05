<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\Company as CompanyEntity;
use Core\Infra\Factory\CompanyFactoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{

    private $factory;

    public function __construct(CompanyFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function save(CompanyEntity $companyEntity): CompanyEntity
    {
        $company = $this->factory->create($companyEntity);
        dd($company);
        // Aqui, o modelo Eloquent é salvo pelo método create da factory
        return $company;
    }
}
