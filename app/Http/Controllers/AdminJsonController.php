<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class AdminJsonController extends Controller
{
    public function update()
    {
        $admins = Admin::all()->map(function ($admin) {
            return [
                'admin_id' => $admin->admin_id,
                'admin_name'     => $admin->admin_name,
                'email'    => $admin->email,
            ];
        });

        Storage::disk('public')->put('json/admins.json', $admins->toJson(JSON_PRETTY_PRINT));
        return response()->json(['message' => 'Admins JSON updated successfully.']);
    }
}