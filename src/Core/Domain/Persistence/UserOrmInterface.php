<?php

namespace Core\Domain\Persistence;

use Core\Domain\Entity\User;

interface UserOrmInterface
{
    public function create(User $user): User;
}
