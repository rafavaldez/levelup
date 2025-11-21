<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
    use HasFactory;

    protected $table = 'pago_detalles';

    protected $fillable = [
        'pago_id',
        'matricula_detalle_id',
        'monto_aplicado',
    ];

    protected $casts = [
        'monto_aplicado' => 'decimal:2',
    ];

    // Pertenece a un pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }

    // Pertenece a un detalle de matrícula
    public function matriculaDetalle()
    {
        return $this->belongsTo(MatriculaDetalle::class, 'matricula_detalle_id');
    }
}
