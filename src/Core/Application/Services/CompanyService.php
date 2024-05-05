<?php

namespace Core\Application\Services;

use Core\Application\DTO\CreateCompanyInput;
use Core\UseCase\Company\CreateCompanyUseCase;

class CompanyService
{
    private $createCompanyUseCase;

    public function __construct(CreateCompanyUseCase $createCompanyUseCase)
    {
        $this->createCompanyUseCase = $createCompanyUseCase;
    }

    public function registerCompany(CreateCompanyInput $input)
    {
        return $this->createCompanyUseCase->execute($input);
    }
}