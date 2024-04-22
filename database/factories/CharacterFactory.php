<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'enemy' => fake()->boolean(),
            'defence' => fake()->numberBetween(0, 20),
            'strength' => fake()->numberBetween(0, 20),
            'accuracy' => fake()->numberBetween(0, 20),
            'magic' => fake()->numberBetween(0, 20),
        ];
    }
}
