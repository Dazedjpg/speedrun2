<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // optional
use Illuminate\Http\Request;


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

}
