<?php

namespace Core\Domain\Repositories;

use Core\Domain\Entity\Company;

interface CompanyRepositoryInterface
{
    public function save(Company $company): Company;
}
