<?php

namespace Core\Domain\Repositories;

use Core\Domain\Entity\CompanyGateway;

interface CompanyGatewayRepositoryInterface
{
    public function save(CompanyGateway $companyGateway): CompanyGateway;
}
