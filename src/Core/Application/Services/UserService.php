<?php

namespace Core\Application\Services;

use Core\Domain\Entity\User;
use Core\Domain\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function registerUser(string $email, string $password): User
    {
        //$user = new User($email, $password); // Considerando que User é uma entidade com validações adequadas
        //return $this->userRepository->save($user);
    }
}
