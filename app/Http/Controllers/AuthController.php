<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }

    // Logout (invalidate JWT)
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Berhasil logout']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token tidak valid atau sudah logout'], 400);
        }
    }

    // Ambil data user dari JWT
    public function me()
    {
        return response()->json(auth()->user());
    }
}
