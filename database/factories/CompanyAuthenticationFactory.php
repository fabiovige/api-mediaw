<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyAuthentication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyAuthentication>
 */
class CompanyAuthenticationFactory extends Factory
{
    protected $model = CompanyAuthentication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_company' => Company::factory(),
            'token_api_service' => $this->faker->uuid,
        ];
    }
}
