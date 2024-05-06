<?php

namespace Core\UseCase\Company;

use Core\Application\DTO\Company\{
    CreateCompanyInput,
    CreateCompanyOutput
};

use Core\Domain\Entity\Company;
use Core\Domain\Repositories\CompanyRepositoryInterface;

class CreateCompanyUseCase
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
    ){}

    public function execute(CreateCompanyInput $input): CreateCompanyOutput
    {
        $companyEntity = new Company(
            id_company: null,
            company: $input->company,
            cnpj: $input->cnpj,
            user_id: $input->user_id
        );

        $company = $this->companyRepository->save($companyEntity);

        return new CreateCompanyOutput(
            id_company: $company->id_company,
            company: $company->company,
            cnpj: $company->cnpj,
            user_id: $company->user_id,
        );
    }
}