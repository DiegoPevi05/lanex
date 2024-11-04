<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WebReview;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class WebReviewFactory extends Factory
{

    protected $model = WebReview::class;
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
