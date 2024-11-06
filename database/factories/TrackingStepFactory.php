<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TrackingStep;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class TrackingStepFactory extends Factory
{

    protected $model = TrackingStep::class;
    protected static $sequenceCounter = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sequence = self::$sequenceCounter;
        self::$sequenceCounter = self::$sequenceCounter >= 5 ? 1 : self::$sequenceCounter + 1;

        return [
            'sequence' => $sequence,
            'origin' => $this->faker->text(40),
            'destination' => $this->faker->text(40),
            'status' => 'PENDING'
        ];
    }

}
