<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;

class SearchController extends Controller
{
    public function suggest(Request $request)
    {
        $q = strtolower($request->get('q'));

        $gameResults = Game::where('game_title', 'LIKE', "%$q%")
            ->get()
            ->map(function ($game) {
                return [
                    'label' => '🎮 ' . $game->game_title,
                    'url' => url('/games/' . $game->game_id),
                ];
            });

        $userResults = User::where('name', 'LIKE', "%$q%")
            ->get()
            ->map(function ($user) {
                return [
                    'label' => '👤 ' . $user->name,
                    'url' => url('/users/' . $user->user_id),
                ];
            });

        return response()->json($gameResults->concat($userResults));
    }
}

