<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\CompanyGateway as CompanyGatewayEntity;
use Core\Domain\Persistence\CompanyGatewayOrmInterface;
use Core\Domain\Repositories\CompanyGatewayRepositoryInterface;

class CompanyGatewayRepository implements CompanyGatewayRepositoryInterface
{
    public function __construct(
        private CompanyGatewayOrmInterface $orm
    ){}

    public function save(CompanyGatewayEntity $companyEntity): CompanyGatewayEntity
    {
        $companyGateway = $this->orm->create($companyEntity);
        return $companyGateway;
    }
}
