<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function exportToJson()
    {
        $admins = Admin::all();

        Storage::disk('public')->put('json/admin.json', $admins->toJson(JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Admins exported to admin.json']);
    }

    public function showJson()
    {
        $path = 'json/admin.json';

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'admin.json not found.');
        }

        return response()->file(storage_path("app/public/{$path}"), [
            'Content-Type' => 'application/json'
        ]);
    }

    public function create()
    {
        return view('admin.create'); // buat file resources/views/admin/create.blade.php
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'admin_name' => $request->admin_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login.form')->with('success', 'Admin berhasil dibuat. Silakan login.');
    }



}
