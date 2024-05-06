<?php

namespace Core\Domain\Repositories;

use Core\Domain\Entity\CompanyAuthentication;

interface CompanyAuthenticationRepositoryInterface
{
    public function save(CompanyAuthentication $companyAuthentication): CompanyAuthentication;
}
