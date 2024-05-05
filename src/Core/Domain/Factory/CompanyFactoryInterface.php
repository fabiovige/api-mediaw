<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\Company;

interface CompanyFactoryInterface
{
    public function create(Company $company): Company;
}
