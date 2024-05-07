<?php

namespace Core\Application\Services;

use Core\Application\DTO\Company\CreateCompanyInput;
use Core\Application\DTO\CompanyAuthentication\CreateCompanyAuthenticationInput;
use Core\Application\DTO\CompanyGateway\CreateCompanyGatewayInput;
use Core\Application\DTO\User\CreateUserInput;

use Core\Domain\Exception\CompanyValidationExcpetion;
use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\TransactionalInterface;
use Core\Domain\Interfaces\UuidGeneratorInterface;

use Core\UseCase\Company\CreateCompanyUseCase;
use Core\UseCase\CompanyGateway\CreateCompanyGatewayUseCase;
use Core\UseCase\CompanyAuthentication\CreateCompanyAuthenticationUseCase;
use Core\UseCase\User\CreateUserUseCase;

class CompanyService
{
    public function __construct(
        private CreateCompanyUseCase $createCompanyUseCase,
        private CreateUserUseCase $createUserUseCase,
        private CreateCompanyAuthenticationUseCase $createCompanyAuthenticationUseCase,
        private CreateCompanyGatewayUseCase $createCompanyGatewayUseCase,
        private UuidGeneratorInterface $uuidGenerator,
        private HasherInterface $hasher,
        private TransactionalInterface $transaction,
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

            // criar a compania
            $input->user_id = $user->id;
            $company = $this->createCompanyUseCase->execute($input);

            // criar company_authentication
            $companyAuthentication = $this->createCompanyAuthenticationUseCase->execute(new CreateCompanyAuthenticationInput(
                id_company: $company->id_company,
                token_api_service: $uuid,
            ));

            $this->transaction->commit();

            return $company;

        } catch (CompanyValidationExcpetion $e) {
            $this->transaction->rollback();
            throw $e;
        }
    }
}