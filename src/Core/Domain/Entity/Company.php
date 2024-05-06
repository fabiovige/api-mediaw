<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagics;
use Core\Domain\Exception\CompanyValidationExcpetion;

class Company
{

    use MethodsMagics;

    public function __construct(
        protected ?int $id_company = null,
        protected string $company,
        protected string $cnpj,
        protected int $user_id
    ){
        $this->validate();
    }

    public function validate()
    {
        //dd($this->company, strlen($this->company));
        if (empty($this->company) ) {
            throw new CompanyValidationExcpetion("Nome da compania é obrigatório");
        }

        if (strlen($this->company) <= 3) {
            throw new CompanyValidationExcpetion("Nome não pode ser menor que 3");
        }

        if (strlen($this->company) > 150) {
            throw new CompanyValidationExcpetion("Nome não pode ser maior que 150");
        }

        if (empty($this->cnpj) && strlen($this->company) != 14){
            throw new CompanyValidationExcpetion("Cnpj inválido");
        }
    }

    // Getters
    public function getIdCompany(): int {
        return $this->id_company;
    }

    public function getCompany(): string {
        return $this->company;
    }

    public function getCnpj(): string {
        return $this->cnpj;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    // Setters
    public function setIdCompany(int $id_company): void {
        $this->id_company = $id_company;
    }
}