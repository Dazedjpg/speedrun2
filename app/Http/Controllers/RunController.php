<?php

namespace App\Http\Controllers;
use App\Models\Run;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RunController extends Controller
{
    public function index()
    {
        $json = Storage::disk('public')->get('json/runs.json');
        $runs = json_decode($json, true);

        return view('runs.index', ['runs' => $runs]);
    }

    public function show($id)
    {
        $json = Storage::disk('public')->get('json/runs.json');
        $runs = json_decode($json, true);

        $run = collect($runs)->firstWhere('run_id', $id);

        if (!$run) {
            abort(404, 'Run not found');
        }

        return view('runs.show', ['run' => $run]);
    }

    public function updateRunsJson()
    {
        $runs = Run::with(['game:game_id,game_title']) // relasi opsional
                    ->select('run_id', 'user_id', 'game_id', 'category_id', 'rank', 'runner', 'time', 'status', 'video', 'submitted_at')

                    ->get();

        $jsonData = json_encode($runs, JSON_PRETTY_PRINT);

        Storage::disk('public')->put('json/runs.json', $jsonData);

        return response()->json(['message' => 'runs.json berhasil diperbarui']);
    }

    
    public function create($id)
    {
        $game = Game::findOrFail($id);

        // Opsi 1: dari JSON
        $jsonPath = storage_path('app/public/json/categories.json');
        $categories = json_decode(file_get_contents($jsonPath), true);

        // Opsi 2: jika langsung dari DB
        // $categories = Category::all();

        return view('runs.create', compact('game', 'categories'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'runner' => 'required|string|max:100',
            'time' => 'required|string',
            'status' => 'required|string',
            'category_id' => 'required|integer',
            'video' => 'nullable|url',
        ]);

        // Tambahkan user_id dari auth
        DB::table('runs')->insert([
            'game_id' => $id,
            'runner' => $request->runner,
            'time' => $request->time,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'video' => $request->video,
            'submitted_at' => now(),
            'user_id' => auth()->id(),
            'rank' => null
        ]);


        // Panggil fungsi untuk update JSON
        $this->updateRunsJson(); // langsung panggil private method

        return redirect()->route('games.show', ['id' => $id])->with('success', 'Run submitted!');
    }

}
