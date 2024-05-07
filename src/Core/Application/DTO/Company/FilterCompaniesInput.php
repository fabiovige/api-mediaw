<?php

namespace Core\Application\DTO\Company;

class FilterCompaniesInput
{
    public function __construct(
        public ?string $company = null,
        public ?string $cnpj = null,
        // Adicione outros critérios de filtragem conforme necessário
    ) {}
}
