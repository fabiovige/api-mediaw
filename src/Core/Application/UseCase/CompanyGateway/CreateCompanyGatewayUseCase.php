<?php

namespace Core\Application\UseCase\CompanyGateway;

use Core\Application\DTO\CompanyGateway\{
    CreateCompanyGatewayInput,
    CreateCompanyGatewayOutput
};

use Core\Domain\Entity\CompanyGateway;
use Core\Domain\Repositories\CompanyGatewayRepositoryInterface;

class CreateCompanyGatewayUseCase
{
    public function __construct(
        protected CompanyGatewayRepositoryInterface $companyGatewayRepository,
    ){}

    public function execute(CreateCompanyGatewayInput $input): CreateCompanyGatewayOutput
    {
        dd($input);
        $companyEntity = new CompanyGateway(
            id: null,
            idCompany: $input->idCompany,
            nameGateway: $input->nameGateway,
            publicKey: $input->publicKey,
            liveApiKey: $input->liveApiKey,
            recipientId: $input->recipientId
        );

        $companyGateway = $this->companyGatewayRepository->save($companyEntity);
        dd($companyEntity);

        return new CreateCompanyGatewayOutput(
            id: $companyGateway->id,
            idCompany: $companyGateway->idCompany,
            nameGateway: $companyGateway->nameGateway,
            publicKey: $companyGateway->publicKey,
            liveApiKey: $companyGateway->liveApiKey,
            recipientId: $companyGateway->recipientId
        );

    }
}