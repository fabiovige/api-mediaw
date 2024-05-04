<?php

namespace Core\Domain\DTO;

class CreateCompanyOutput
{
    public function __construct(
        public int $id_company,
        public string $company,
        public string $cnpj
    ){}
}