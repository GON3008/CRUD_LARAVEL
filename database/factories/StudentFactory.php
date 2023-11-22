<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'code' => fake()->unique()->text(10),
            'date_of_birth' => fake()->date(),
            'img' => fake()->imageUrl(),
            'is_active' => rand(0, 1),
        ];
    }
}
