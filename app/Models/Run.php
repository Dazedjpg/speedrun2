<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // optional

class Run extends Model
{
    protected $table = 'runs';
    protected $primaryKey = 'run_id'; // penting!
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'category_id',
        'user_id',
        'rank',
        'runner',
        'time',
        'status',
        'video',
        'submitted_at',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function store(Request $request)
    {
        Run::create([
            'game_id' => $request->game_id,
            'user_id' => auth()->id(), // ← otomatis ambil dari user yang sedang login
            'time' => $request->time,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'video' => $request->video,
            'submitted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Run berhasil ditambahkan!');
    }

}
