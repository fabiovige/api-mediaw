<?php

namespace Core\Application\Services;

use Core\Application\DTO\Company\{
    CreateCompanyInput
};
use Core\Application\DTO\User\CreateUserInput;
use Core\Domain\Exception\CompanyValidationExcpetion;
use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\TransactionalInterface;
use Core\Domain\Interfaces\TransactionalSession;
use Core\Domain\Interfaces\UuidGeneratorInterface;
use Core\UseCase\Company\CreateCompanyUseCase;
use Core\UseCase\User\CreateUserUseCase;

class CompanyService
{
    public function __construct(
        private CreateCompanyUseCase $createCompanyUseCase,
        private CreateUserUseCase $createUserUseCase,
        private UuidGeneratorInterface $uuidGenerator,
        private HasherInterface $hasher,
        private TransactionalInterface $transaction
    ){}

    public function registerCompany(CreateCompanyInput $input)
    {
        $this->transaction->beginTransaction();
        try {
            $uuid = $this->uuidGenerator->generate();

            // criar o usuario
            $user = $this->createUserUseCase->execute(new CreateUserInput(
                name: $input->company,
                email: $input->email,
                password: $this->hasher->make($uuid)
            ));

            // criar a compania passando o user_id
            $input->user_id = $user->id;
            $company = $this->createCompanyUseCase->execute($input);

            $this->transaction->commit();
            return $company;

        } catch (CompanyValidationExcpetion $e) {
            $this->transaction->rollback();
            throw $e;
        }
    }
}