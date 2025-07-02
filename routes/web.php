<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GameController;



use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create'); // <-- TARUH DI ATAS
Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit'); // <-- TARUH DI ATAS
Route::post('/games', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show'); // TARUH PALING BAWAH
Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');


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
Route::middleware(['web'])->group(function () {

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});