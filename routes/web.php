<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RunController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserJsonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ExportJsonController;


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

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
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

Route::get('/categories.json', function () {
    $path = 'json/categories.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'categories.json not found.');
    }

    return response()->file(storage_path("app/public/{$path}"), [
        'Content-Type' => 'application/json'
    ]);
})->name('categories.json');

Route::get('/update-runs-json', [RunController::class, 'updateRunsJson']);

Route::get('/runs', [RunController::class, 'index'])->name('runs.index');
Route::get('/runs/{id}', [RunController::class, 'show'])->name('runs.show');
Route::get('/games/{id}/submit-run', [RunController::class, 'create'])->name('runs.create');
Route::post('/games/{id}/submit-run', [RunController::class, 'store'])->name('runs.store');


Route::get('/update-categories-json', [CategoryController::class, 'updateCategoryJson'])->name('categories.updateJson');
Route::get('/categories.json', function () {
    $path = 'json/categories.json';

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File categories.json tidak ditemukan');
    }

    return response(Storage::disk('public')->get($path), 200)
        ->header('Content-Type', 'application/json');
});
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


Route::get('/users-json-update', [UserJsonController::class, 'update'])->name('users.json.update');
Route::get('/users-json', [UserJsonController::class, 'fetch'])->name('users.json.fetch');
Route::get('/users/{id}', [UserJsonController::class, 'show']);

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Ini untuk Blade UI + @guest/@auth agar route('login') dikenali
Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/signin', [AuthController::class, 'login'])->name('signin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Jika pakai endpoint auth API:
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.register.form');
Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.register');


Route::middleware('auth:admin')->group(function () {
    // Game Management
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    // Category & Run Management
    Route::resource('/categories', CategoryController::class)->except(['index', 'show']);
    Route::resource('/runs', RunController::class)->only(['edit', 'update', 'destroy']);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');

// Untuk user biasa
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Untuk admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/profile', [App\Http\Controllers\AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile', [App\Http\Controllers\AdminProfileController::class, 'update'])->name('admin.profile.update');
});

// ===== USER =====
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ADMIN =====
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile/delete', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

Route::get('/export/users', [ExportJsonController::class, 'exportUsers']);
Route::get('/export/admins', [ExportJsonController::class, 'exportAdmins']);