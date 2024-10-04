<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'external_id' => 'service_' . Str::random(5),
            'name' => $this->faker->company(),
            'icon' => $this->randomIcon(),
            'short_description' => $this->faker->text(80),
            'webcontent' => json_encode([
                'image' => '/images/aboutus.jpg',
                'header' => $this->faker->text(30),
                'title' => $this->faker->text(50),
                'description' => $this->faker->text(200),
                'overview' => [
                    'header' => $this->faker->text(20),
                    'title' => $this->faker->text(50),
                    'image' => '/images/svg/services_1.svg',
                    'content' => [
                        'header' => $this->faker->text(200),
                        'introduction' => $this->faker->text(400),
                        'content' => $this->faker->text(600),
                    ],
                ],
                'keypoints' => [
                    'header' => $this->faker->text(30),
                    'title' => $this->faker->text(50),
                    'points' => $this->generatePoints(6),  // Call method to generate points
                ],
                'faqs' => [
                    'title' => $this->faker->text(50),
                    'questions' => $this->generateQuestions(5),  // Call method to generate questions
                ]
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Generate a random icon from a predefined array.
     *
     * @return string
     */
    private function randomIcon(): string
    {
        $icons = [
            'ri-ship-fill',
            'heroicon-o-truck',
            'bi-airplane-fill'
        ];

        return $this->faker->randomElement($icons);
    }

    /**
     * Generate an array of points.
     *
     * @param int $count
     * @return array
     */
    private function generatePoints(int $count): array
    {
        return collect(range(1, $count))->map(function () {
            return [
                'title' => $this->faker->text(30),
                'content' => $this->faker->text(400),
            ];
        })->toArray();
    }

    /**
     * Generate an array of FAQ questions.
     *
     * @param int $count
     * @return array
     */
    private function generateQuestions(int $count): array
    {
        return collect(range(1, $count))->map(function ($id) {
            return [
                'id' => $id,  // Add the unique id
                'question' => $this->faker->text(40),
                'answer' => $this->faker->text(400),
            ];
        })->toArray();
    }
}
