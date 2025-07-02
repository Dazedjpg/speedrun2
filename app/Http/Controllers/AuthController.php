<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Coba login sebagai Admin
        $admin = DB::table('admin')->where('admin_name', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            session(['is_admin' => true, 'admin_id' => $admin->admin_id, 'admin_name' => $admin->admin_name]);
            return redirect('/dashboard'); // Ganti dengan halaman khusus admin jika perlu
        }

        // Coba login sebagai User
        $user = DB::table('users')->where('name', $username)->first();
        if ($user && Hash::check($password, $user->password)) {
            session(['is_admin' => false, 'user_id' => $user->id, 'user_name' => $user->name]);
            return redirect('/'); // Halaman utama user
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('signin.form');
    }
}
