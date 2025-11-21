<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'codigo',
        'fecha_pago',
        'monto_total',
        'usuario_cajero_id',
        'metodo_pago_id',
        'tipo',
        'comentarios',
    ];

    protected $casts = [
        'fecha_pago'  => 'datetime',
        'monto_total' => 'decimal:2',
    ];

    // Usuario cajero que registró el pago
    public function usuarioCajero()
    {
        return $this->belongsTo(User::class, 'usuario_cajero_id');
    }

    // Método de pago
    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    // Detalles (distribución del pago en matricula_detalles)
    public function detalles()
    {
        return $this->hasMany(PagoDetalle::class, 'pago_id');
    }
}
