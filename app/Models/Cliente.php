<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'telefono',
        'email',
        'direccion',
        'fecha_registro',
        'estado',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_registro'   => 'datetime',
    ];

    // Un cliente tiene muchas matrículas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'cliente_id');
    }

    // Helper simple para nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}
