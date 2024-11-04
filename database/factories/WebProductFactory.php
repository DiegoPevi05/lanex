<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\WebProduct;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class WebProductFactory extends Factory
{

    protected $model = WebProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(40),
            'image' => $this->randomImage(),
            'stars' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->text(600),
            'EAN' => Str::random(10)
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
            '/images/test/celular.webp',
            '/images/test/hp_product.webp'
        ];

        return $this->faker->randomElement($icons);
    }
}
