<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
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
            'serial' => fake()->unique()->text(100),
            'model' => fake()->text(100),
            'img' => fake()->imageUrl(),
            'description' => fake()->text(),
            'is_active' => rand(0, 1),
        ];
    }
}
