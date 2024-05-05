<?php

namespace Core\Application\DTO\User;

class CreateUserOutput
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password
    ){}
}