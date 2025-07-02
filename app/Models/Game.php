<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';
    public $timestamps = false;

    // Tambahkan ini
    protected $fillable = [
        'game_title',
        'cover_image',
        'description',
        'created_at', // opsional, jika kamu pakai
        // tambahkan kolom lain yang ingin kamu izinkan untuk mass assignment
    ];

    public function runs()
    {
        return $this->hasMany(Run::class, 'game_id');
    }
}
