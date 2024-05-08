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

    public function getEmail(string $token_api_service): string
    {
        return $this->orm->getEmail($token_api_service);
    }

    public function getTokenApiService(string $cnpj): string
    {
        return $this->orm->getTokenApiService($cnpj);
    }
}
