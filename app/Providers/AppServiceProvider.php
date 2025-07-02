<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

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
        // Load games.json
        $gamesJson = Storage::disk('public')->get('json/games.json');
        $games = json_decode($gamesJson, true);

        // Load users.json
        $usersJson = Storage::disk('public')->get('json/users.json');
        $users = json_decode($usersJson, true);

        // Share to all views (like navbar)
        View::share('games', $games);
        View::share('users', $users);
    }
}
