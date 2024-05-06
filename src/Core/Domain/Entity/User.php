<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagics;
use Core\Domain\Exception\CompanyValidationExcpetion;

class User
{
    use MethodsMagics;

    public function __construct(
        protected ?int $id = null,
        protected string $name,
        protected string $email,
        protected string $password
    ) {
        $this->validate();
    }

    public function validate()
    {
        if (empty($this->name)) {
            throw new CompanyValidationExcpetion("Nome do usuário é obrigatório");
        }
        if (empty($this->password)) {
            throw new CompanyValidationExcpetion("Senha do usuário é obrigatório");
        }
    }

    // Getters
    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    // Setters (opcional, se você quiser permitir modificação após a criação)
    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
        $this->validate();
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
        $this->validate();
    }
}
