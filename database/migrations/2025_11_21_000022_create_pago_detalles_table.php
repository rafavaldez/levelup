<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pago_detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pago_id')
                  ->constrained('pagos')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->foreignId('matricula_detalle_id')
                  ->constrained('matricula_detalles')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->decimal('monto_aplicado', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pago_detalles');
    }
};
