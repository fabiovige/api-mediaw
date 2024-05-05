<?php

namespace Core\UseCase\Company;

use Core\Application\DTO\{
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
        $companyEntity = new Company(
            company: $input->company,
            cnpj: $input->cnpj
        );

        $newCompany = $this->repository->save($companyEntity);

        return new CreateCompanyOutput(
            id_company: $newCompany->id_company,
            company: $newCompany->company,
            cnpj: $newCompany->cnpj,
        );
    }
}