<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CompanyResource;
use App\Models\Company;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        $companies = QueryBuilder::for(Company::class)
            ->allowedFilters(['id_company', 'company', 'cnpj'])
            ->paginate(10);

        return CompanyResource::collection(
            resource: $companies
        );
    }

}
