<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\Api\V1\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreController
{
    public function __invoke(StoreCompanyRequest $request)
    {
        DB::beginTransaction();

        try {
            $uuid = Uuid::uuid4();

            $user = User::create([
                'name' => $request->company,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($uuid),
                'remember_token' => Str::random(10),
            ]);

            $company = Company::create([
                'company' => $request->company,
                'cnpj' => $request->cnpj,
                'user_id' => $user->id
            ]);

            $company->company_authentication()->create([
                'token_api_service' =>  $uuid
            ]);

            $company->company_gateways()->createMany($request->gateways);

            DB::commit();

            return new CompanyResource($company);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'data' => [
                    'message' => 'Falha ao relizar o cadastro',
                    'error' => $e->getMessage()
                ],
            ], 500);
        }
    }
}
