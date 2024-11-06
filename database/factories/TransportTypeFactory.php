<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TransportType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class TransportTypeFactory extends Factory
{

    protected $model = TransportType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->text(40),
            'icon' => '/images/test/truck.svg',
            'name' => $this->faker->company(),
            'description' => $this->faker->text(200),
            'status' => 'ACTIVE'
        ];
    }

}
