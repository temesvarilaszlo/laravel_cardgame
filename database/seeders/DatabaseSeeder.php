<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Giga Admin',
            'email' => 'admin@admin.com',
            'admin' => true,
        ]);

        User::factory(10)->create();

        $this->call([
            CharacterSeeder::class,
            PlaceSeeder::class,
            ContestSeeder::class,
        ]);
    }
}
