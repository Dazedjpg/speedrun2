<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Menampilkan halaman Sign Up (Blade)
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Menampilkan halaman Sign In (Blade)
    public function showSigninForm()
    {
        return view('auth.signin');
    }

    // [Diperlukan Laravel untuk redirect user yang belum login]
    public function showLoginForm()
    {
        return view('auth.signin');
    }

    // Proses Sign Up (return JSON + token)
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User registered successfully',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

    // Proses Login (return JWT token)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Email atau password salah'], 401);
            } else {
                return back()->withErrors(['email' => 'Email atau password salah']);
            }
        }

        // Simpan user ke session Laravel agar @auth bisa bekerja
        $user = auth()->user();
        auth()->login($user);

        if ($request->wantsJson()) {
            return response()->json([
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth('api')->factory()->getTTL() * 60,
            ]);
        } else {
            return redirect('/')->with('success', 'Berhasil login!');
        }
    }

    // Logout (invalidate JWT)
 public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
