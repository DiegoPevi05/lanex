<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WebSupplier;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class WebSupplierFactory extends Factory
{
    protected $model = WebSupplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->company(),
            'logo'=> $this->randomImage(),
            'description'=>$this->faker->text(400),
            'details' => json_encode([
                $this->faker->text(200),
                $this->faker->text(200),
                $this->faker->text(200),
            ])

        ];
    }

    /**
     * Generate a random image url from a predefined array.
     *
     * @return string
     */
    private function randomImage(): string
    {
        $icons = [
            '/images/test/interbank.svg'
        ];

        return $this->faker->randomElement($icons);
    }
}
