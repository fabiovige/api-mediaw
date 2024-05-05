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
        //$user = $this->userService->registerUser($input->email, $input->password); // Supondo que esses dados venham no input

        $userEntity = new User(
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