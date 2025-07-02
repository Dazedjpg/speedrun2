<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';

    public function runs()
    {
        return $this->hasMany(Run::class, 'game_id');
    }

    public function getFastestRunAttribute()
    {
        return $this->runs->sortBy(function ($run) {
            preg_match('/(?:(\d+)m)?\s*(?:(\d+)s)?\s*(?:(\d+)ms)?/', $run->time, $matches);
            return (int)($matches[1] ?? 0) * 60000 + (int)($matches[2] ?? 0) * 1000 + (int)($matches[3] ?? 0);
        })->first();
    }
}
