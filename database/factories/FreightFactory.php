<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Freight;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class FreightFactory extends Factory
{

    protected $model = Freight::class;
    /**
     * Define the model's default state.
     *
     * @return array<text, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(200),
            'origin' => $this->faker->text(40),
            'dimensions_units' => 'cm',
            'dimensions' => $this->faker->numberBetween(10, 99),
            'weigth_units' => 'kg',
            'weigth' => $this->faker->numberBetween(10, 99),
            'volume_units' => 'cm3',
            'volume' => $this->faker->numberBetween(10, 99),
            'packages' => $this->faker->numberBetween(1, 10),
            'incoterms' => $this->faker->text(20)
        ];
    }

}
