<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function updateGamesJson()
    {
        $games = Game::select('game_id', 'game_title', 'description', 'cover_image')->get();

        $jsonData = json_encode($games, JSON_PRETTY_PRINT);

        Storage::disk('public')->put('json/games.json', $jsonData);

        return response()->json(['message' => 'games.json berhasil diperbarui']);
    }

    public function index()
    {
        $games = Game::select('game_id', 'game_title', 'description', 'cover_image')->get();

        return view('games', ['games' => $games]);
    }

    public function show($id)
    {
        $game = Game::where('game_id', $id)->firstOrFail();

        // Kalau kamu punya halaman detail, render di sini
        return view('game-detail', ['game' => $game]);
    }
}