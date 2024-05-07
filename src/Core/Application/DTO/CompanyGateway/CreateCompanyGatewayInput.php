<?php

namespace Core\Application\DTO\CompanyGateway;

class CreateCompanyGatewayInput
{
    public function __construct(
        public ?int $id = null,
        public ?int $idCompany = null,
        public string $nameGateway,
        public string $publicKey,
        public string $liveApiKey,
        public string $recipientId
    ){}
}