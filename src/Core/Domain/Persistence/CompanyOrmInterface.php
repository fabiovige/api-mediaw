<?php

namespace Core\Domain\Persistence;

use Core\Domain\Entity\Company;

interface CompanyOrmInterface
{
    public function create(Company $company): Company;
}
