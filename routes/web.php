<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RunController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserJsonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

Route::get('/users/update-json', [UserJsonController::class, 'updateJson'])->name('users.updateJson');
Route::get('/users/json', [UserJsonController::class, 'viewJson'])->name('users.viewJson');

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create'); // <-- TARUH DI ATAS
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

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create'); // <-- TARUH DI ATAS
Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit'); // <-- TARUH DI ATAS
Route::post('/games', [GameController::class, 'store'])->name('games.store');
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show'); // TARUH PALING BAWAH
Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');
Route::get('/categories', [CategoryController::class, 'exportToJson']);


Route::get('/export-admins', [AdminController::class, 'exportToJson'])->name('export.admins');
Route::get('/admin.json', [AdminController::class, 'showJson'])->name('admin.json');


Route::get('/runs.json', function () {
    $path = 'json/runs.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File runs.json tidak ditemukan');
    }

    return response(Storage::disk('public')->get($path), 200)
        ->header('Content-Type', 'application/json');
});

Route::get('/users.json', function () {
    $path = 'json/users.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File users.json tidak ditemukan');
    }

    $contents = Storage::disk('public')->get($path);

    return response($contents, 200)
        ->header('Content-Type', 'application/json');
});

Route::get('/category.json', function () {
    $path = 'json/category.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'category.json not found.');
    }

    return response()->file(storage_path("app/public/{$path}"), [
        'Content-Type' => 'application/json'
    ]);
})->name('category.json');

Route::get('/update-runs-json', [RunController::class, 'updateRunsJson']);

Route::get('/runs', [RunController::class, 'index'])->name('runs.index');
Route::get('/runs/{id}', [RunController::class, 'show'])->name('runs.show');
Route::get('/games/{id}/submit-run', [RunController::class, 'create'])->name('runs.create');
Route::post('/games/{id}/submit-run', [RunController::class, 'store'])->name('runs.store');


Route::get('/users-json-update', [UserJsonController::class, 'update'])->name('users.json.update');
Route::get('/users-json', [UserJsonController::class, 'fetch'])->name('users.json.fetch');
Route::get('/users/{id}', [UserJsonController::class, 'show']);

use App\Http\Controllers\AuthController;
Route::middleware(['web'])->group(function () {

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin.form');

Route::post('/signin', [AuthController::class, 'login'])->name('signin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');
Route::get('/api/search-suggestions', [App\Http\Controllers\SearchController::class, 'suggest']);