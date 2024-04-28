<?php

namespace App\Providers;

use App\Models\Character;
use App\Models\Place;
use App\Policies\CharacterPolicy;
use App\Policies\PlacePolicy;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Character::class => CharacterPolicy::class,
        Place::class => PlacePolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
