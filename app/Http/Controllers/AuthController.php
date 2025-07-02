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

public function showSigninForm()
{
    return view('auth.signin');
}

public function signin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Email atau password salah.');
    }

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('/profile');

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
