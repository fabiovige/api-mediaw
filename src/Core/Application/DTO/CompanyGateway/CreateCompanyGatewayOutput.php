<?php

namespace Core\Application\DTO\CompanyGateway;

class CreateCompanyGatewayOutput
{
    public function __construct(
        public ?int $id = null,
        public int $idCompany,
        public string $nameGateway,
        public string $publicKey,
        public string $liveApiKey,
        public string $recipientId
    ){}
}