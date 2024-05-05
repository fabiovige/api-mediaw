<?php

namespace Core\Infra\Factory;

use Core\Domain\Entity\User;
use App\Models\User as UserModel;
use Core\Domain\Exception\UniqueConstraintViolationException;
use Core\Domain\Factory\UserFactoryInterface;
use Exception;

class EloquentUserFactory implements UserFactoryInterface
{
    public function create(User $user): User
    {
        try {
            //dd($user->name);
            $eloquentUser = UserModel::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password
            ]);

            $user->id = $eloquentUser->id;
            dd($user, $eloquentUser);
            //$user->id = $eloquentUser->id;
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

