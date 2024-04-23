<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyAuthentication;
use App\Models\CompanyGateway;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(30)
            ->has(CompanyAuthentication::factory()->count(1), 'company_authentication')
            ->has(CompanyGateway::factory()->count(2), 'company_gateways')
            ->create();
    }
}
