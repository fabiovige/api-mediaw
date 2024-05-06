<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\CompanyAuthentication;
use Core\Domain\Persistence\CompanyAuthenticationOrmInterface;
use Core\Domain\Repositories\CompanyAuthenticationRepositoryInterface;

class CompanyAuthenticationRepository implements CompanyAuthenticationRepositoryInterface
{
    public function __construct(
        private CompanyAuthenticationOrmInterface $orm
    ){}

    public function save(CompanyAuthentication $entity): CompanyAuthentication
    {
        $companyAuthentication = $this->orm->create($entity);
        return $companyAuthentication;
    }
}
