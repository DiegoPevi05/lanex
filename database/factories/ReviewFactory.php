<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{

    protected $model = Review::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(40),
            'charge'=> $this->faker->texT(10),
            'date_review'=> now(),
            'review'=> $this->faker->text(500),
            'stars' => $this->faker->numberBetween(1, 5)
        ];
    }
}
