<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageContent = file_get_contents(fake()->imageUrl(200, 200)); // Get image content from URL

        // Create a temporary file with a unique name
        $tempImagePath = tempnam(sys_get_temp_dir(), 'image_');
        file_put_contents($tempImagePath, $imageContent);

        // Use the store method to save the image, which will generate a hashed filename
        $image = Storage::disk('public')->putFile('place_images', new File($tempImagePath));
        // $image = new File($tempImagePath)->store();

        // $image = $this->faker->image(storage_path('/app/public'), 200, 200, fullPath: false);
        // $image = fake()->image(storage_path('app/public'), 200, 200);
        // dd($image);
        // $image = fake()->boolean() ? 'image.png' : null;
        return [
            'name' => fake()->word(),
            'image' => $image,
            'image_hash' => $image,
        ];
    }
}
