<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ClientFactory extends Factory
{

    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'client_id' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'company' => 'PENDING',
            'RUC' => $this->faker->numerify('###########'),
            'cellphone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

}
