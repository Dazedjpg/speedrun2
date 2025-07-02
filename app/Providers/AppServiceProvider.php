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
        // Default fallback kalau file tidak ada
        $games = [];
        $users = [];

        if (Storage::disk('public')->exists('json/games.json')) {
            $gamesJson = Storage::disk('public')->get('json/games.json');
            $games = json_decode($gamesJson, true) ?? [];
        }

        if (Storage::disk('public')->exists('json/users.json')) {
            $usersJson = Storage::disk('public')->get('json/users.json');
            $users = json_decode($usersJson, true) ?? [];
        }

        View::share('games', $games);
        View::share('users', $users);
    }

}
