<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class OrderFactory extends Factory
{

    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'order_number' => Order::generateOrderNumber(),
            'status' => 'PENDING',
            'details' => $this->faker->text(200),
            'net_amount' => $this->faker->numberBetween(0, 1000),
            'taxes' => $this->faker->numberBetween(0,18),
            'operative_cost' => $this->faker->numberBetween(100,150),
            'numero_dam' => $this->faker->numberBetween(1000000, 9999999),
            'manifest' => $this->faker->numberBetween(1000000, 9999999),
            'channel' => $this->faker->numberBetween(1000000, 9999999),
        ];
    }

}
