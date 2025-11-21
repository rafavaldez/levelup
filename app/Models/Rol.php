<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
    ];

    // Un rol tiene muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
