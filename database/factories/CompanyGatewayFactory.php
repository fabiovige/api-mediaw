<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyGateway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyGateway>
 */
class CompanyGatewayFactory extends Factory
{
    protected $model = CompanyGateway::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_company' => Company::factory(),
            'name_gateway' => $this->faker->word,
            'public_key' => $this->faker->randomNumber(),
            'live_api_key' => $this->faker->randomNumber(),
            'recipient_id' => $this->faker->randomNumber(),
        ];
    }
}
