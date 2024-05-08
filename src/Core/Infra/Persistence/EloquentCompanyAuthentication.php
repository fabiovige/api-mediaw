<?php

namespace Core\Infra\Persistence;

use App\Models\CompanyAuthentication as CompanyAuthenticationModel;
use Core\Domain\Entity\CompanyAuthentication;
use Core\Domain\Exception\UniqueConstraintViolationException;
use Core\Domain\Persistence\CompanyAuthenticationOrmInterface;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function getEmail($token_api_service): string
    {
        if($token_api_service === null){
            throw new Exception("Token Api Service não foi informado!: ");
        }

        $email = DB::table('company_authentication as ca')
        ->join('company as c', 'c.id_company', '=', 'ca.id_company')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->where('ca.token_api_service', $token_api_service)
        ->value('u.email');

        if(!$email){
            throw new Exception("Token Api Service não encontrado!: ");
        }

        return $email;
    }

    public function getTokenApiService(string $cnpj): string
    {
        if($cnpj === null){
            throw new Exception("CNPJ não foi informado!: ");
        }

        $tokenApiService = DB::table('company as c')
        ->join('company_authentication as ca', 'ca.id_company', '=', 'c.id_company')
        ->where('c.cnpj', $cnpj)
        ->value('ca.token_api_service');


        if(!$tokenApiService){
            throw new Exception("CNPJ não encontrado!: ");
        }

        return $tokenApiService;
    }

}
