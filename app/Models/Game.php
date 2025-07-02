<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'game_id';
    public $timestamps = false;

    protected $fillable = ['game_title', 'description', 'cover_image'];
}