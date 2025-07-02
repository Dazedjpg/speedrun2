<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $primaryKey = 'user_id'; // <-- Penting!
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'users';  

    public $timestamps = false; // Nonaktifkan timestamps jika tidak ada created_at & updated_at

    protected $fillable = ['name', 'email', 'password'];


    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
    