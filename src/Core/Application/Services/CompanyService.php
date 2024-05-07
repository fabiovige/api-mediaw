<?php

namespace Core\Application\Services;

use Core\Application\DTO\Company\CreateCompanyInput;
use Core\Application\DTO\Company\FilterCompaniesInput;
use Core\Application\DTO\CompanyAuthentication\CreateCompanyAuthenticationInput;
use Core\Application\DTO\CompanyGateway\CreateCompanyGatewayInput;
use Core\Application\DTO\User\CreateUserInput;

use Core\Domain\Exception\CompanyValidationExcpetion;
use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\TransactionalInterface;
use Core\Domain\Interfaces\UuidGeneratorInterface;

use Core\Application\UseCase\Company\CreateCompanyUseCase;
use Core\Application\UseCase\Company\FilterCompaniesUseCase;
use Core\Application\UseCase\CompanyGateway\CreateCompanyGatewayUseCase;
use Core\Application\UseCase\CompanyAuthentication\CreateCompanyAuthenticationUseCase;
use Core\Application\UseCase\User\CreateUserUseCase;

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
        private FilterCompaniesUseCase $filterCompaniesUseCase
    ){}

    public function registerCompany(CreateCompanyInput $input)
    {
        $this->transaction->beginTransaction();
        try {
            $uuid = $this->uuidGenerator->generate();

            // Adiciona usuario
            $user = $this->createUserUseCase->execute(new CreateUserInput(
                name: $input->company,
                email: $input->email,
                password: $this->hasher->make($uuid)
            ));

            // Adiciona compania e gateway
            $input->user_id = $user->id;
            $company = $this->createCompanyUseCase->execute($input);

            // Adiciona token api service company_authentication
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

    public function filterCompanies(FilterCompaniesInput $input)
    {
        return $this->filterCompaniesUseCase->execute($input);
    }
}