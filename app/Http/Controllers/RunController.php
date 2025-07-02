<?php

namespace App\Http\Controllers;
use App\Models\Run;
use Illuminate\Support\Facades\Storage;

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
}
