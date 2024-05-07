<?php

namespace Core\Application\UseCase\Company;

use Core\Application\DTO\Company\FilterCompaniesInput;
use Core\Domain\Repositories\CompanyRepositoryInterface;

class FilterCompaniesUseCase
{
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function execute(FilterCompaniesInput $input)
    {
        return $this->companyRepository->findByCriteria($input);
    }
}
