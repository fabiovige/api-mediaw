<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagics;
use Core\Domain\Exception\CompanyValidationExcpetion;

class CompanyAuthentication
{
    use MethodsMagics;

    public function __construct(
        protected ?int $id = null,
        protected int $id_company,
        protected string $token_api_service,
    ){
        $this->validate();
    }

    public function validate()
    {
        if (empty($this->id_company)) {
            throw new CompanyValidationExcpetion("Nome da compania é obrigatório");
        }

        if (empty($this->token_api_service)) {
            throw new CompanyValidationExcpetion("Token Api Service obrigatório");
        }
    }

    // Getters
    public function getIdCompany(): int {
        return $this->id_company;
    }

    public function getTokenApiService(): string {
        return $this->token_api_service;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }
}
