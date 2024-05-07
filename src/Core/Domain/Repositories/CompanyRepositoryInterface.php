<?php

namespace Core\Domain\Repositories;

use Core\Application\DTO\Company\FilterCompaniesInput;
use Core\Domain\Entity\Company;

interface CompanyRepositoryInterface
{
    public function save(Company $company): Company;
    public function findByCriteria(FilterCompaniesInput $criteria);
}
