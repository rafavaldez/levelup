<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'codigo',
        'cliente_id',
        'fecha_matricula',
        'usuario_registro_id',
        'monto_matricula',
        'moneda',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_matricula' => 'datetime',
        'monto_matricula' => 'decimal:2',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Usuario (cajero/recepción) que registró la matrícula
    public function usuarioRegistro()
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }

    // Detalles (cursos contratados en esta matrícula)
    public function detalles()
    {
        return $this->hasMany(MatriculaDetalle::class, 'matricula_id');
    }

    // Total de cursos (sin contar matrícula)
    public function getTotalCursosAttribute()
    {
        return $this->detalles->sum('precio_final');
    }

    // Total general (cursos + costo de matrícula)
    public function getTotalConMatriculaAttribute()
    {
        return $this->monto_matricula + $this->total_cursos;
    }
}
