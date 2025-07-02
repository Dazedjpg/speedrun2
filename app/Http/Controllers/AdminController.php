<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

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
}
