<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\User as UserEntity;
use Core\Domain\Factory\UserFactoryInterface;
use Core\Domain\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private UserFactoryInterface $factory
    ){}

    public function save(UserEntity $userEntity): UserEntity
    {
        $user = $this->factory->create($userEntity);
        dd($user);
        // Aqui, o modelo Eloquent é salvo pelo método create da factory
        return $user;
    }
}
