<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|integer|exists:games,game_id',
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Menyimpan ke database
        Category::create($validated);

        // Sinkron ke JSON
        $this->updateCategoryJson();

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    private function updateCategoryJson()
    {
        $categories = Category::all()->map(function ($c) {
            return [
                'category_id' => $c->category_id,
                'game_id' => $c->game_id,
                'name' => $c->category_name, // disesuaikan dengan kolom di DB
                'description' => $c->description,
            ];
        });

        Storage::disk('public')->put('json/categories.json', $categories->toJson(JSON_PRETTY_PRINT));
    }
}
