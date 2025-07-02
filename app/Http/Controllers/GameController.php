<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function updateGamesJson()
    {
        $games = Game::select('game_id', 'game_title', 'description', 'cover_image')->get();

        $jsonData = json_encode($games, JSON_PRETTY_PRINT);

        Storage::disk('public')->put('json/games.json', $jsonData);

        return response()->json(['message' => 'games.json berhasil diperbarui']);
    }

    public function index() {
        $games = Game::all();
        return view('games', compact('games'));
    }

    public function create() {
        return view('games.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'game_title' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image'
        ]);

        $imageName = time() . '.' . $request->cover_image->extension();
        $request->cover_image->move(public_path('img'), $imageName);

        Game::create([
            'game_title' => $validated['game_title'],
            'description' => $validated['description'],
            'cover_image' => $imageName
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan!');
    }

    public function edit($id) {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'game_title' => 'required|string|max:255',
        'description' => 'required|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $game = Game::findOrFail($id);

    $game->game_title = $request->game_title;
    $game->description = $request->description;

    // Jika cover image diunggah, update filenya
    if ($request->hasFile('cover_image')) {
        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('img'), $filename);

        $game->cover_image = $filename;
    }

    $game->save();

    return redirect()->route('games.index')->with('success', 'Game berhasil diperbarui.');
}
    public function destroy($id) {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game berhasil dihapus!');
    }

    public function show($id) {
        $game = Game::findOrFail($id);
        return view('games.show', compact('game'));
    }


}