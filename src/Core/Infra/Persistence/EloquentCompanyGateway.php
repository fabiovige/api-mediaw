<?php

namespace Core\Infra\Persistence;

use Core\Domain\Entity\CompanyGateway;
use App\Models\CompanyGateway as CompanyGatewayModel;
use Core\Domain\Persistence\CompanyGatewayOrmInterface;

class EloquentCompanyGateway implements CompanyGatewayOrmInterface
{
    public function create(CompanyGateway $paymentGateway): CompanyGateway
    {
        $model = CompanyGatewayModel::create([
            'id_company' => $paymentGateway->getIdCompany(),
            'name_gateway' => $paymentGateway->getNameGateway(),
            'public_key' => $paymentGateway->getPublicKey(),
            'live_api_key' => $paymentGateway->getLiveApiKey(),
            'recipient_id' => $paymentGateway->getRecipientId(),
        ]);

        $paymentGateway->setId($model->id);
        return $paymentGateway;
    }

    public function findByCompany(int $companyId): array
    {
        return [];
    }
}
