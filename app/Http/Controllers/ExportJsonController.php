<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Admin;

class ExportJsonController extends Controller
{
    public function exportUsers()
    {
        $users = User::all()->map(function ($u) {
            return [
                'user_id' => $u->user_id,
                'name' => $u->name,
                'email' => $u->email,
            ];
        });

        Storage::disk('public')->put('json/users.json', $users->toJson(JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Users exported']);
    }

    public function exportAdmins()
    {
        $admins = Admin::all()->map(function ($a) {
            return [
                'admin_id' => $a->admin_id ?? $a->id,
                'name' => $a->name,
                'email' => $a->email,
            ];
        });

        Storage::disk('public')->put('json/admins.json', $admins->toJson(JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Admins exported']);
    }
}
