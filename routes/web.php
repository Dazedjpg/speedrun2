<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GameController;



Route::get('/', function () {
    return view('home');
});


Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

Route::get('/games.json', function () {
    $path = 'json/games.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File games.json tidak ditemukan');
    }

    $contents = Storage::disk('public')->get($path);
    
    return response($contents, 200)
        ->header('Content-Type', 'application/json');
});

Route::get('/update-games-json', [GameController::class, 'updateGamesJson']);




use App\Http\Controllers\AuthController;

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');