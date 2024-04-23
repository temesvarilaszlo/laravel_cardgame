<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\User;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Character::factory(fake()->numberBetween(0,5))
                ->for($user)
                ->create(
                    $user->admin ?
                    ['user_id' => $user->id] :
                    ['user_id' => $user->id, 'enemy' => false]
                );
        }
    }
}
