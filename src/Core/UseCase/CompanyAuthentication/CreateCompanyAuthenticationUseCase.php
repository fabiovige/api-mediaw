<?php

namespace Core\UseCase\CompanyAuthentication;

use Core\Application\DTO\CompanyAuthentication\{
    CreateCompanyAuthenticationInput,
    CreateCompanyAuthenticationOutput
};

use Core\Domain\Entity\CompanyAuthentication;
use Core\Domain\Repositories\CompanyAuthenticationRepositoryInterface;

class CreateCompanyAuthenticationUseCase
{
    public function __construct(
        protected CompanyAuthenticationRepositoryInterface $companyAuthenticationRepository
    ){}

    public function execute(CreateCompanyAuthenticationInput $input): CreateCompanyAuthenticationOutput
    {
        $companyAuthenticationEntity = new CompanyAuthentication(
            id: null,
            id_company: $input->id_company,
            token_api_service: $input->token_api_service
        );

        $company = $this->companyAuthenticationRepository->save($companyAuthenticationEntity);

        return new CreateCompanyAuthenticationOutput(
            id: $company->id,
            id_company: $company->id_company,
            token_api_service: $company->token_api_service,
        );

    }
}