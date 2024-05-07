<?php

namespace Core\Application\UseCase\Company;

use Core\Application\DTO\Company\{
    CreateCompanyInput,
    CreateCompanyOutput
};
use Core\Application\DTO\CompanyGateway\CreateCompanyGatewayOutput;
use Core\Domain\Entity\Company;
use Core\Domain\Entity\CompanyGateway;
use Core\Domain\Repositories\CompanyGatewayRepositoryInterface;
use Core\Domain\Repositories\CompanyRepositoryInterface;

class CreateCompanyUseCase
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected CompanyGatewayRepositoryInterface $companyGatewayRepository,
    ){}

    public function execute(CreateCompanyInput $input): CreateCompanyOutput
    {
        $companyEntity = new Company(
            id_company: null,
            company: $input->company,
            cnpj: $input->cnpj,
            user_id: $input->user_id
        );

        $company = $this->companyRepository->save($companyEntity);
        $gateways = [];

        foreach ($input->gateways as $gatewayInput) {
            $gateway = new CompanyGateway(
                id: null,
                idCompany: $company->id_company,
                nameGateway: $gatewayInput->nameGateway,
                publicKey: $gatewayInput->publicKey,
                liveApiKey: $gatewayInput->liveApiKey,
                recipientId: $gatewayInput->recipientId
            );

            $this->companyGatewayRepository->save($gateway);

            $gateways[] = new CreateCompanyGatewayOutput(
                id: $gateway->getId(),
                idCompany: $gateway->getIdCompany(),
                nameGateway: $gateway->getNameGateway(),
                publicKey: $gateway->getPublicKey(),
                liveApiKey: $gateway->getLiveApiKey(),
                recipientId: $gateway->getRecipientId()
            );
        }

        return new CreateCompanyOutput(
            id_company: $company->id_company,
            company: $company->company,
            cnpj: $company->cnpj,
            user_id: $company->user_id,
            gateways: $gateways,
        );
    }
}