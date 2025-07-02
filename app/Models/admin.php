<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id'; // Primary key bukan "id"

    public $timestamps = false; // Jika tidak ada created_at / updated_at

    protected $fillable = ['admin_name', 'password'];

    protected $hidden = ['password'];

    // Gunakan admin_name sebagai "username"
    public function getAuthIdentifierName()
    {
        return 'admin_name';
    }

    public function getAuthIdentifier()
    {
        return $this->admin_name;
    }
}
