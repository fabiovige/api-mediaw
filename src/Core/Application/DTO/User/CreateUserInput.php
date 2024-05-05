<?php

namespace Core\Application\DTO\User;

class CreateUserInput
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ){}
}