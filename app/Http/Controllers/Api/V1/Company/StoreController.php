<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\Api\V1\CompanyResource;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class StoreController
{
    public function __invoke(StoreCompanyRequest $request)
    {
        DB::beginTransaction();

        try {
            $company = Company::create($request->all());

            $company->company_authentication()->create([
                'token_api_service' =>  \Ramsey\Uuid\Uuid::uuid4()
            ]);

            $company->company_gateways()->createMany($request->gateways);

            DB::commit();

            return new CompanyResource($company);

            //return response()->json(['message' => 'Company created successfully', 'data' => $company], 201);

        } catch (\Exception $e) {
            // Em caso de erro, reverte a transação
            DB::rollBack();

            // Retorna uma resposta de erro
            return response()->json(['message' => 'Failed to create company', 'error' => $e->getMessage()], 500);
        }
    }
}
