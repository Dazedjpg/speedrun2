<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';  
    protected $primaryKey = 'user_id'; // Kolom primary key kamu

    public $timestamps = false; // Nonaktifkan timestamps jika tidak ada created_at & updated_at

    protected $fillable = ['name', 'email', 'password'];


    protected $hidden = [
        'password',
    ];

    // Otentikasi berdasarkan email
    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
    