<?php

namespace Core\Infra\Persistence;

use App\Models\CompanyAuthentication as CompanyAuthenticationModel;
use Core\Domain\Entity\CompanyAuthentication;
use Core\Domain\Exception\UniqueConstraintViolationException;
use Core\Domain\Persistence\CompanyAuthenticationOrmInterface;
use Exception;

class EloquentCompanyAuthentication implements CompanyAuthenticationOrmInterface
{
    public function create(CompanyAuthentication $companyAuthentication): CompanyAuthentication
    {
        try {
            $newCompanyAuthentication = CompanyAuthenticationModel::create([
                'id_company' => $companyAuthentication->getIdCompany(),
                'token_api_service' => $companyAuthentication->getTokenApiService(),
            ]);
            $companyAuthentication->setId($newCompanyAuthentication->id);

            return $companyAuthentication;

        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'company__auhentication_token_api_service_unique')) {
                throw new UniqueConstraintViolationException("O token api service fornecido já está em uso.");
            }

            throw new Exception("Erro ao criar token api service: " + $e->getMessage());
        }
    }
}
