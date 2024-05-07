<?php

namespace Core\Domain\Persistence;

use Core\Domain\Entity\CompanyGateway;

interface CompanyGatewayOrmInterface
{
    public function create(CompanyGateway $paymentGateway): CompanyGateway;
    //public function findByCompany(int $companyId): array;
}
