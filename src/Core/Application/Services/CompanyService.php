<?php

namespace Core\Application\Services;

use Core\Application\DTO\Company\{
    CreateCompanyInput
};
use Core\Application\DTO\User\CreateUserInput;
use Core\Domain\Exception\CompanyValidationExcpetion;
use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\UuidGeneratorInterface;
use Core\UseCase\Company\CreateCompanyUseCase;
use Core\UseCase\User\CreateUserUseCase;

class CompanyService
{
    public function __construct(
        private CreateCompanyUseCase $createCompanyUseCase,
        private CreateUserUseCase $createUserUseCase,
        private UuidGeneratorInterface $uuidGenerator,
        private HasherInterface $hasher
    ){}

    public function registerCompany(CreateCompanyInput $input)
    {
        //dd($input);
        try {
            $uuid = $this->uuidGenerator->generate();
            $password = $this->hasher->make($uuid);

            $dtoUser = new CreateUserInput(
                name: $input->company,
                email: $input->email,
                password: $password,
            );


            $user = $this->createUserUseCase->execute($dtoUser);
            // criar o usuario

            // criar a compania passando o user_id
            return $this->createCompanyUseCase->execute($input);

        } catch (CompanyValidationExcpetion $e) {
            // Tratar qualquer outra exceção genérica
           dd('teste');  
        }
    }
}