<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman Sign Up (Blade UI)
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Tampilkan halaman Sign In (Blade UI)
    public function showSigninForm()
    {
        return view('auth.signin');
    }

    // Proses Sign Up (API)
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User registered successfully',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

    // Proses Login (API)
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return back()->with('error', 'Email atau password salah');
    }

    $user = auth()->user();
    Auth::login($user); // session-based login agar Blade tahu usernya login

    session(['jwt_token' => $token]); // simpan token jika ingin pakai lagi

    return redirect('/')->with('success', 'Berhasil login');
}



    // Ambil data user dari token JWT
    public function me()
    {
        return response()->json(auth()->user());
    }

    // Logout & invalidasi token
    public function logout(Request $request)
{
    Auth::logout(); // logout dari Laravel
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    try {
        JWTAuth::invalidate(JWTAuth::getToken()); // logout JWT
    } catch (\Exception $e) {
        // Abaikan jika token invalid
    }

    return redirect('/signin')->with('success', 'Berhasil logout');
}


}
