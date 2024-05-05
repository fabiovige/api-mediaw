<?php

namespace Core\Application\DTO;

class CreateCompanyInput
{
    public function __construct(
        public string $company,
        public string $cnpj
    ){}
}