<?php

namespace Core\Application\DTO\Company;

class CreateCompanyOutput
{
    public function __construct(
        public int $id_company,
        public string $company,
        public string $cnpj,
        public int $user_id,
        public array $gateways = []
    ){}
}