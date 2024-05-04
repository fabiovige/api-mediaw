<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\Company;

interface CompanyRepositoryInterface
{
    public function save(Company $company): Company;
}
