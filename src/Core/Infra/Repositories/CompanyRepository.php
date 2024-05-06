<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\Company as CompanyEntity;
use Core\Domain\Persistence\CompanyOrmInterface;
use Core\Domain\Repositories\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(
        private CompanyOrmInterface $orm
    ){}

    public function save(CompanyEntity $companyEntity): CompanyEntity
    {
        $company = $this->orm->create($companyEntity);
        return $company;
    }
}
