<?php

namespace App\Http\Controllers\Api\V1;

use Core\Application\DTO\{
    CreateCompanyInput
};
use Core\Application\Services\CompanyService;
use Core\Domain\Exception\CompanyValidationExcpetion;
use Illuminate\Http\Request;

class CompanyController
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function store(Request $request)
    {
        try {
            $dto = new CreateCompanyInput(
                company: $request->input('company'),
                cnpj: $request->input('cnpj')
            );

            $result = $this->companyService->registerCompany($dto);

            return response()->json($result, 201);

        } catch(CompanyValidationExcpetion $e) {
            return response()->json([
                'erro' => $e->getMessage()
            ], 422);
        }
    }
}
