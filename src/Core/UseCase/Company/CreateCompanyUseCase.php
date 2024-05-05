<?php

namespace Core\UseCase\Company;

use Core\Application\DTO\Company\{
    CreateCompanyInput,
    CreateCompanyOutput
};
use Core\Application\Services\UserService;
use Core\Domain\Entity\Company;
use Core\Domain\Repositories\CompanyRepositoryInterface;
use Core\Domain\Repositories\UserRepositoryInterface;

class CreateCompanyUseCase
{

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected UserService $userService,
    ){}

    public function execute(CreateCompanyInput $input): CreateCompanyOutput
    {
        //$user = $this->userService->registerUser($input->email, $input->password); // Supondo que esses dados venham no input

        $companyEntity = new Company(
            company: $input->company,
            cnpj: $input->cnpj
        );

        $newCompany = $this->companyRepository->save($companyEntity);

        return new CreateCompanyOutput(
            id_company: $newCompany->id_company,
            company: $newCompany->company,
            cnpj: $newCompany->cnpj,
        );
    }
}