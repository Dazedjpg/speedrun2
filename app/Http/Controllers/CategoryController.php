<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function exportToJson()
    {
        $categories = Category::all();

        Storage::disk('public')->put('json/category.json', $categories->toJson(JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Categories exported to category.json']);
    }
}
