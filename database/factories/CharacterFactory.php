<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

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
        $attributes = [
            'name' => fake()->name(),
            'enemy' => fake()->boolean(),
            'defence' => fake()->numberBetween(0, 3),
            'strength' => fake()->numberBetween(0, 20),
            'accuracy' => fake()->numberBetween(0, 20),
            'magic' => fake()->numberBetween(0, 20),
        ];

        return $this->lessThanTwenty($attributes);
    }

    /**
     * Helper function to make the generated data fit the requirements.
     * @return array<string, mixed>
     */
    public function lessThanTwenty(array $attributes): array
    {
        $total = $attributes['defence'] + $attributes['strength'] + $attributes['accuracy'] + $attributes['magic'];

        if ($total > 20) {
            $scalingFactor = 20 / $total;
            $attributes['defence'] *= $scalingFactor;
            $attributes['strength'] *= $scalingFactor;
            $attributes['accuracy'] *= $scalingFactor;
            $attributes['magic'] *= $scalingFactor;
        }

        $attributes['defence'] = (int) $attributes['defence'];
        $attributes['strength'] = (int) $attributes['strength'];
        $attributes['accuracy'] = (int) $attributes['accuracy'];
        $attributes['magic'] = (int) $attributes['magic'];

        return $attributes;
    }
}
