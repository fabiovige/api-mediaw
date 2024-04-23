<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Resources\Api\V1\CompanyResource;
use App\Models\Company;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController
{
    public function __invoke()
    {
        $companies = QueryBuilder::for(Company::class)
            ->allowedFilters(['id_company', 'company', 'cnpj'])
            ->paginate(10);

        return CompanyResource::collection(
            resource: $companies
        );
    }
}
