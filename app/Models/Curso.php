<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_mensual_base',
        'activo',
    ];

    protected $casts = [
        'precio_mensual_base' => 'decimal:2',
        'activo'              => 'boolean',
    ];

    // Un curso tiene muchos detalles de matrícula
    public function matriculaDetalles()
    {
        return $this->hasMany(MatriculaDetalle::class, 'curso_id');
    }

    // Un curso tiene muchos descuentos por plazo
    public function descuentosPlazo()
    {
        return $this->hasMany(DescuentoCursoPlazo::class, 'curso_id');
    }
}
