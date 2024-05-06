<?php

namespace Core\Application\DTO\CompanyAuthentication;

class CreateCompanyAuthenticationInput
{
    public function __construct(
        public int $id_company,
        public string $token_api_service,
    ){}
}