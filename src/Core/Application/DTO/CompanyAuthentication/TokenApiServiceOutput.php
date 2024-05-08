<?php

namespace Core\Application\DTO\CompanyAuthentication;

class TokenApiServiceOutput
{
    public function __construct(
        public string $token_api_service,
    ){}
}