<?php

namespace Core\Application\UseCase\Auth;

use Core\Infra\Repositories\CompanyAuthenticationRepository;

class ObtemTokenApiServiceUseCase
{
    public function __construct(
        protected CompanyAuthenticationRepository $companyAuthenticationRepository,
    ){}

    public function execute(string $cnpj): string
    {
        return $this->companyAuthenticationRepository->getTokenApiService($cnpj);
    }
}