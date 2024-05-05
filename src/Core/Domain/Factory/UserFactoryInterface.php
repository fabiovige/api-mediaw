<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\User;

interface UserFactoryInterface
{
    public function create(User $user): User;
}
