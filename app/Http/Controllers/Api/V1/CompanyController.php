<?php

namespace App\Http\Controllers\Api\V1;

use Core\Domain\DTO\CreateCompanyDTO;
use Core\Domain\DTO\CreateCompanyInput;
use Core\Domain\Services\CompanyService;
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

        $dto = new CreateCompanyInput(
            company: $request->input('company'),
            cnpj: $request->input('cnpj')
        );

        $result = $this->companyService->registerCompany($dto);

        return response()->json($result, 201);
    }
}
