<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    public function suggest(Request $request)
    {
        $q = strtolower($request->query('q'));

        $games = collect(json_decode(Storage::disk('public')->get('json/games.json'), true));
        $users = collect(json_decode(Storage::disk('public')->get('json/users.json'), true));

        $results = [];

        foreach ($games as $g) {
            if (str_starts_with(strtolower($g['game_title']), $q)) {
                $results[] = [
                    'type' => 'game',
                    'name' => $g['game_title'],
                    'url' => url("/games/{$g['game_id']}")
                ];
            }
        }

        foreach ($users as $u) {
            if (str_starts_with(strtolower($u['name']), $q)) {
                $results[] = [
                    'type' => 'user',
                    'name' => $u['name'],
                    'url' => url("/users/{$u['user_id']}")
                ];
            }
        }

        return response()->json(array_slice($results, 0, 10));
    }
}
