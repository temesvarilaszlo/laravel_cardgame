<?php

namespace App\Providers;

use App\Models\Character;
use App\Policies\CharacterPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::policy(Character::class, CharacterPolicy::class);
        // Validator::extend('sum_of_attributes', function ($attribute, $value, $parameters, $validator) {
        //     $defence = $validator->getData()['defence'] ?? 0;
        //     $strength = $validator->getData()['strength'] ?? 0;
        //     $accuracy = $validator->getData()['accuracy'] ?? 0;
        //     $magic = $validator->getData()['magic'] ?? 0;

        //     // Calculate the sum of attributes
        //     $sum = $defence + $strength + $accuracy + $magic;

        //     // Validate the sum against the specified range
        //     return $sum <= 20;
        // });
    }
}
