<?php

namespace Core\Domain\Repositories;

use Core\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): User;
}
