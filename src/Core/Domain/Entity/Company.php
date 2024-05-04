<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagics;
use Core\Domain\Exception\CompanyValidationExcpetion;

class Company
{

    use MethodsMagics;

    public function __construct(
        protected string $company,
        protected string $cnpj
    ){
        $this->validate();
    }

    public function validate()
    {
        if (empty($this->company) || strlen($this->company) <= 3 && strlen($this->company) > 255){
            throw new CompanyValidationExcpetion("Nome inválido");
        }

        if (empty($this->cnpj) || strlen($this->company) != 14){
            throw new CompanyValidationExcpetion("Cnpj inválido");
        }
    }

}