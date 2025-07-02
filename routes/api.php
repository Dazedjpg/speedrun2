<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/games', function (Request $request) {
    $data = $request->only(['game_id', 'game_title', 'description', 'cover_image']);

    $path = 'json/games.json';
    $games = [];

    if (Storage::disk('public')->exists($path)) {
        $games = json_decode(Storage::disk('public')->get($path), true);
    }

    $games[] = $data;

    Storage::disk('public')->put($path, json_encode($games, JSON_PRETTY_PRINT));

    return response()->json(['message' => 'Game added successfully'], 201);
});
