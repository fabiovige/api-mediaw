<?php

namespace Core\UseCase\Company;

use Core\Domain\DTO\{
    CreateCompanyInput,
    CreateCompanyOutput
};
use Core\Domain\Entity\Company;
use Core\Infra\Repositories\CompanyRepositoryInterface;

class CreateCompanyUseCase
{
    protected $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateCompanyInput $input): CreateCompanyOutput
    {
        $company = new Company(
            company: $input->company,
            cnpj: $input->cnpj
        );

        $newCompany = $this->repository->save($company);

        return new CreateCompanyOutput(
            id_company: $newCompany->id_company,
            company: $newCompany->company,
            cnpj: $newCompany->cnpj,
        );
    }
}