<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active'         => 'boolean',
    ];

    // 🔹 Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    // 🔹 Matrículas registradas por este usuario
    public function matriculasRegistradas()
    {
        return $this->hasMany(Matricula::class, 'usuario_registro_id');
    }

    // 🔹 Pagos registrados por este usuario
    public function pagosRegistrados()
    {
        return $this->hasMany(Pago::class, 'usuario_cajero_id');
    }
}
