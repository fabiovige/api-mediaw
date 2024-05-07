<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CompanyResource;
use Illuminate\Http\Request;
use Core\Application\DTO\Company\{
    CreateCompanyInput,
    FilterCompaniesInput
};
use Core\Application\DTO\CompanyGateway\CreateCompanyGatewayInput;
use Core\Application\Services\CompanyService;
use Core\Domain\Exception\UniqueConstraintViolationException;


class CompanyController extends Controller
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
                gateways: array_map(function ($gateway) {
                    return new CreateCompanyGatewayInput(
                        id: null,
                        idCompany: null,
                        nameGateway: $gateway['name_gateway'],
                        publicKey: $gateway['public_key'],
                        liveApiKey: $gateway['live_api_key'],
                        recipientId: $gateway['recipient_id']
                    );
                }, $request->gateways ?? [])
            );

            $result = $this->companyService->registerCompany($dto);

            return response()->json($result, 201);

        } catch (UniqueConstraintViolationException $e) {
            return response()->json(['error' => $e->getMessage()], 409);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function filter(Request $request)
    {
        $input = new FilterCompaniesInput(
            company: $request->input('company'),
            cnpj: $request->input('cnpj')
        );

        $companies = $this->companyService->filterCompanies($input);
        return CompanyResource::collection($companies);
    }
}
