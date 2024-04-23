<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contest>
 */
class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jsonData = [
            'key1' => 'value1',
            'key2' => 'value2',
            'nested' => [
                'nested_key1' => 'nested_value1',
                'nested_key2' => 'nested_value2',
            ]
        ];

        return [
            'win' => null,
            'history' => $jsonData
            // 'history' => json_decode( json_encode($jsonData), true),
        ];
    }
}
