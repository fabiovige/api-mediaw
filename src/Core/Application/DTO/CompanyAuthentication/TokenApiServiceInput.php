<?php

namespace Core\Application\DTO\CompanyAuthentication;

class TokenApiServiceInput
{
    public function __construct(
        public string $token_api_service,
    ){}
}