<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins'; // nama tabel di database
    protected $primaryKey = 'admin_id'; // ganti ke nama primary key kamu

    public $timestamps = false; // kalau tidak pakai created_at / updated_at

    protected $fillable = [
        'admin_name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
