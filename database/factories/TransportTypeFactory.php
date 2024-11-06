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
            'type' => $this->faker->randomElement(self::$types),
            'icon' => $this->faker->randomElement(self::$icons),
            'name' => $this->faker->company(),
            'description' => $this->faker->text(200),
            'status' => 'ACTIVE'
        ];
    }
    // Add a custom method to set icon and type based on index
    public function withIndex(int $i): static
    {
        return $this->state(function () use ($i) {
            return [
                'type' => self::$types[$i % count(self::$types)],
                'icon' => self::$icons[$i % count(self::$icons)],
            ];
        });
    }

    // Define a static array of icons and types you want to use
    private static array $icons = [
        '/images/svgs/warehouse.svg',
        '/images/svgs/plane-takeoff.svg',
        '/images/svgs/plane-landing.svg',
        '/images/svgs/container.svg',
        '/images/svgs/truck.svg',
        '/images/svgs/house.svg',

        '/images/svgs/warehouse.svg',
        '/images/svgs/ship.svg',
        '/images/svgs/anchor.svg',
        '/images/svgs/container.svg',
        '/images/svgs/truck.svg',
        '/images/svgs/house.svg',
    ];

    private static array $types = [
        'Proveedor',
        'Despegue',
        'Aterrizaje',
        'Aduanas',
        'Currier',
        'Destinatario',

        'Proveedor',
        'Embarcacion',
        'Anclaje',
        'Aduanas',
        'Currier',
        'Destinatario',
    ];

}
