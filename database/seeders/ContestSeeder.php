<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroes = Character::all()->where('enemy', false);
        $enemies = Character::all()->where('enemy', true);
        $places = Place::all();

        foreach($heroes as $hero){
            $contestsNum = fake()->numberBetween(0, 4);

            for ($i=0; $i < $contestsNum; $i++) {
                $hero_hp = fake()->numberBetween(0, 20);
                $enemy_hp = fake()->numberBetween($hero_hp === 0 ? 1 : 0, 20);
                $win = null;

                if ($hero_hp === 0) $win = false;
                if ($enemy_hp === 0) $win = true;

                Contest::factory()
                    ->hasAttached($hero, [
                        "hero_hp" => $hero_hp,
                        "enemy_hp" => $enemy_hp,
                        "enemy_id" => $enemies->random()->id
                    ])
                    ->create([
                        "place_id" => $places->random()->id,
                        "user_id" => $hero->user->id,
                        "win" => $win
                    ]);
            }
        }
    }
}
