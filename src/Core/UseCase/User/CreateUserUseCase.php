<?php

namespace Core\UseCase\User;

use Core\Application\DTO\User\{
    CreateUserInput,
    CreateUserOutput,
};
use Core\Domain\Entity\User;
use Core\Domain\Repositories\UserRepositoryInterface;

class CreateUserUseCase
{

    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ){}

    public function execute(CreateUserInput $input): CreateUserOutput
    {
        $userEntity = new User(
            id: null,
            name: $input->name,
            email: $input->email,
            password: $input->password
        );

        $newUser = $this->userRepository->save($userEntity);

        return new CreateUserOutput(
            id: $newUser->id,
            name: $newUser->name,
            email: $newUser->email,
            password: $newUser->password,
        );
    }
}