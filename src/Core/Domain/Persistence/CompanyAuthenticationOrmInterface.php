<?php

namespace Core\Domain\Persistence;

use Core\Domain\Entity\Company;
use Core\Domain\Entity\CompanyAuthentication;

interface CompanyAuthenticationOrmInterface
{
    public function create(CompanyAuthentication $companyAuthentication): CompanyAuthentication;
}
