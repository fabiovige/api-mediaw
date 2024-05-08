<?php

namespace Core\Domain\Persistence;

use Core\Domain\Entity\CompanyAuthentication;

interface CompanyAuthenticationOrmInterface
{
    public function create(CompanyAuthentication $companyAuthentication): CompanyAuthentication;
    public function getEmail(string $token_api_service): string;
    public function getTokenApiService(string $cnpj): string;
}
