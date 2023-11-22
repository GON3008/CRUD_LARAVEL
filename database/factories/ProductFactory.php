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
            'name' => fake()->text(100),
            'price' => fake()->numberBetween(12,2),
            'price_sale' => fake()->numberBetween(12,2),
            'img' => fake()->imageUrl(),
            'description' => fake()->text(),
            'is_active' => rand(0,1),
        ];
    }
}
