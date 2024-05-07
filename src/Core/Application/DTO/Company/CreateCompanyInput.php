<?php

namespace Core\Application\DTO\Company;

class CreateCompanyInput
{
    public function __construct(
        public string $company,
        public string $cnpj,
        public string $email,
        public ?int $user_id = null,
        public array $gateways = []
    ){}
}