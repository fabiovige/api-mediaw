<?php

namespace Core\Infra\Persistence;

use Core\Domain\Entity\User;
use App\Models\User as UserModel;
use Core\Domain\Exception\UniqueConstraintViolationException;
use Core\Domain\Persistence\UserOrmInterface;
use Exception;

class EloquentUser implements UserOrmInterface
{
    public function create(User $user): User
    {
        try {
            $eloquentUser = UserModel::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);

            $user->setId($eloquentUser->id);
            return $user;

        } catch (Exception $e) {
            // Verificar o código de erro e mensagem para adequar ao tipo de exceção do domínio
            if (str_contains($e->getMessage(), 'users_email_unique')) {
                throw new UniqueConstraintViolationException("O e-mail fornecido já está em uso.");
            }
            throw new Exception("Erro ao criar usuário: " + $e->getMessage());
        }

    }
}

