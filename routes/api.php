<?php

use App\Http\Controllers\AuthController;

Route::post('/signup', [AuthController::class, 'signup']); // Return JWT
Route::post('/login', [AuthController::class, 'login']);   // Return JWT

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']); // Info user login
});
