<?php

namespace Core\Infra\Repositories;

use Core\Domain\Entity\User as UserEntity;
use Core\Domain\Repositories\UserRepositoryInterface;
use Core\Domain\Exception\DomainException;
use Core\Domain\Persistence\UserOrmInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private UserOrmInterface $orm
    ){}

    public function save(UserEntity $userEntity): UserEntity
    {
        try {
            $user = $this->orm->create($userEntity);
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
