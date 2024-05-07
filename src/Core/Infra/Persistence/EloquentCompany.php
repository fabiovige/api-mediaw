<?php

namespace Core\Infra\Persistence;

use Core\Domain\Entity\Company;
use App\Models\Company as CompanyModel;
use Core\Application\DTO\Company\FilterCompaniesInput;
use Core\Domain\Exception\UniqueConstraintViolationException;
use Core\Domain\Persistence\CompanyOrmInterface;
use Exception;
class EloquentCompany implements CompanyOrmInterface
{
    public function create(Company $company): Company
    {
        try {
            $eloquentCompany = CompanyModel::create([
                'company' => $company->getCompany(),
                'cnpj' => $company->getCnpj(),
                'user_id' => $company->getUserId()
            ]);

            $company->setIdCompany($eloquentCompany->id_company);
            return $company;

        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'company_cnpj_unique')) {
                throw new UniqueConstraintViolationException("O cnpj fornecido já está em uso.");
            }

            if (str_contains($e->getMessage(), 'company_company_unique')) {
                throw new UniqueConstraintViolationException("O nome da compania fornecido já existe.");
            }

            throw new Exception("Erro ao criar compania: " + $e->getMessage());
        }
    }

    public function findByCriteria(FilterCompaniesInput $criteria)
    {
        $query = CompanyModel::query();

        if ($criteria->company) {
            $query->where('company', 'like', '%' . $criteria->company . '%');
        }

        if ($criteria->cnpj) {
            $query->where('cnpj', 'like', '%' . $criteria->cnpj . '%');
        }

        // Adicione mais condições conforme necessário

        return $query->get();
    }
}
