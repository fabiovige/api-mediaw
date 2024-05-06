<?php

namespace Core\Application\DTO\CompanyAuthentication;

class CreateCompanyAuthenticationOutput
{
    public function __construct(
        public ?int $id,
        public int $id_company,
        public string $token_api_service,
    ){}
}