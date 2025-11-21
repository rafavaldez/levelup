<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaDetalle extends Model
{
    use HasFactory;

    protected $table = 'matricula_detalles';

    protected $fillable = [
        'matricula_id',
        'curso_id',
        'meses_contratados',
        'fecha_inicio',
        'fecha_fin',
        'precio_unitario_mensual',
        'descuento_curso_plazo_id',
        'precio_final',
        'estado',
    ];

    protected $casts = [
        'meses_contratados'       => 'integer',
        'fecha_inicio'            => 'date',
        'fecha_fin'               => 'date',
        'precio_unitario_mensual' => 'decimal:2',
        'precio_final'            => 'decimal:2',
    ];

    // Pertenece a una matrícula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    // Pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Puede tener un descuento aplicado
    public function descuentoPlazo()
    {
        return $this->belongsTo(DescuentoCursoPlazo::class, 'descuento_curso_plazo_id');
    }

    // Pagos aplicados a este detalle
    public function pagoDetalles()
    {
        return $this->hasMany(PagoDetalle::class, 'matricula_detalle_id');
    }

    // Monto pagado a este detalle
    public function getMontoPagadoAttribute()
    {
        return $this->pagoDetalles->sum('monto_aplicado');
    }

    // Saldo pendiente
    public function getSaldoAttribute()
    {
        return $this->precio_final - $this->monto_pagado;
    }
}
