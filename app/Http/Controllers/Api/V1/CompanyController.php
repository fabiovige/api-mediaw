<?php

namespace App\Http\Controllers\Api\V1;

use Core\Application\DTO\Company\{
    CreateCompanyInput
};
use Core\Application\Services\CompanyService;
use Core\Domain\Exception\CompanyValidationExcpetion;
use Core\Domain\Exception\UniqueConstraintViolationException;
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
                cnpj: $request->input('cnpj'),
                email: $request->input('email'),
            );

            $result = $this->companyService->registerCompany($dto);

            return response()->json($result, 201);

        } catch (UniqueConstraintViolationException $e) {
            return response()->json(['error' => $e->getMessage()], 409);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
