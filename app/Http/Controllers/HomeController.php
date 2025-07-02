<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data game yang dibutuhkan saja
        $games = Game::select('game_id', 'game_title', 'description', 'cover_image')->get();

        // Kirim data ke view home.blade.php
        return view('home', compact('games'));
    }
}
