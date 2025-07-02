<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman Sign Up
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Tampilkan halaman Sign In
    public function showSigninForm()
    {
        return view('auth.signin');
    }

    // Proses Sign Up
    public function signup(Request $request)
    {
        $request->validate([
      'name' => 'required',
        'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6',
]);


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user); // Login otomatis setelah signup

        return redirect('/');
    }



public function signin(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Cari user berdasarkan email
    $user = \App\Models\User::where('email', $request->email)->first();

    // Jika email tidak ditemukan
    if (!$user) {
        return back()->with('error', 'Email tidak terdaftar.');
    }

    // Jika password salah
    if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password salah.');
    }

    // Login dan buat ulang session ID
    \Illuminate\Support\Facades\Auth::login($user);
    $request->session()->regenerate();

    // Redirect ke home
    return redirect('/');
}

public function showLoginForm()
    {
        return view('auth.signin'); // Pastikan file ini ada di resources/views/auth/signin.blade.php
    }

    public function login(Request $request)
    {
        // Proses login nanti di sini
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
