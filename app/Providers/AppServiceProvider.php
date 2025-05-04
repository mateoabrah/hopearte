<?php

namespace App\Providers;

use App\Models\Brewery;
use App\Models\Review;
use App\Policies\BreweryBeerPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Brewery::class => BreweryBeerPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

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
        Vite::prefetch(concurrency: 3);
        
        // Registrar la política de cervecerías
        Gate::policy(Brewery::class, BreweryBeerPolicy::class);
        
        // Registrar la política de reseñas
        Gate::policy(Review::class, ReviewPolicy::class);
        
        // Definir gate para gestionar cervezas de cervecerías
        Gate::define('manage-brewery-beers', function ($user) {
            return in_array($user->role, ['admin', 'company']);
        });
    }
}
