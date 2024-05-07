<?php

namespace Core\Domain\Persistence;

use Core\Application\DTO\Company\FilterCompaniesInput;
use Core\Domain\Entity\Company;

interface CompanyOrmInterface
{
    public function create(Company $company): Company;
    public function findByCriteria(FilterCompaniesInput $criteria);
}
