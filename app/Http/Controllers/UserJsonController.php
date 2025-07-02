<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserJsonController extends Controller
{
    public function update()
    {
        $data = User::select('user_id', 'name')->get();
        Storage::put('users.json', $data->toJson(JSON_PRETTY_PRINT));

        return response()->json(['message' => 'users.json berhasil disimpan']);
    }

    public function fetch()
    {
        if (!Storage::exists('users.json')) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        return response()->json(json_decode(Storage::get('users.json'), true));
    }
}
