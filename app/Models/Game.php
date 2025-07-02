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

   

    public $timestamps = false; // <-- tambahkan ini
}
