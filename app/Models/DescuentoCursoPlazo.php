<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescuentoCursoPlazo extends Model
{
    use HasFactory;

    protected $table = 'descuentos_curso_plazo';

    protected $fillable = [
        'curso_id',
        'meses',
        'precio_promocional_total',
        'fecha_inicio_vigencia',
        'fecha_fin_vigencia',
        'activo',
    ];

    protected $casts = [
        'meses'                   => 'integer',
        'precio_promocional_total'=> 'decimal:2',
        'fecha_inicio_vigencia'   => 'date',
        'fecha_fin_vigencia'      => 'date',
        'activo'                  => 'boolean',
    ];

    // Pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Puede estar referenciado por muchos detalles de matrícula
    public function matriculaDetalles()
    {
        return $this->hasMany(MatriculaDetalle::class, 'descuento_curso_plazo_id');
    }
}
