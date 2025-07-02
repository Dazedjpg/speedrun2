<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\AuthController;

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');