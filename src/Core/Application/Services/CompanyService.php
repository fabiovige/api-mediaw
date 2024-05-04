<?php

namespace Core\Domain\Services;

use Core\Domain\DTO\CreateCompanyInput;
use Core\Domain\Entity\Company;
use Core\Domain\ValueObjects\CompanyId;
use Core\Infra\Repositories\CompanyRepositoryInterface;
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
        //dd($dto);
        /*$dto = new Company( // Geração de um ID único para a companhia
            $dto->company,
            $dto->cnpj // Inclusão do CNPJ
        );
        */

        return $this->createCompanyUseCase->execute($input);

        //$this->repositoryCompany->save($dto); // Salva a nova companhia no repositório

        //return $company;
    }
}