<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagics;
use Core\Domain\Exception\CompanyValidationExcpetion;

class User
{
    use MethodsMagics;

    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password,
    ){
        $this->validate();
    }

    public function validate()
    {
        if (empty($this->name) ) {
            throw new CompanyValidationExcpetion("Nome do usuário é obrigatório");
        }

        if (empty($this->password)) {
            throw new CompanyValidationExcpetion("Senha do usuário é obrigatório");
        }
    }

}