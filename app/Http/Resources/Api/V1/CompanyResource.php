<?php

namespace App\Http\Resources\Api\V1;

use App\Models\CompanyAuthentication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_company' => $this->id_company,
            'company' => $this->company,
            'cnpj' => $this->cnpj,
            'company_authentication' => $this->company_authentication,
            'company_gateways' => $this->company_gateways,
        ];
    }
}
