<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image_url' => $this->faker->randomElement([
                'https://picsum.photos/200/300?random=1',
                'https://picsum.photos/640/480?random=2',
                'https://picsum.photos/640/480?random=3',
            ]),
        ];
    }
}
