<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->dateTime('fecha_pago');
            $table->decimal('monto_total', 10, 2);

            // Cajero (user logueado - Breeze)
            $table->foreignId('usuario_cajero_id')
                  ->constrained('users')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->foreignId('metodo_pago_id')
                  ->constrained('metodos_pago')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->string('tipo', 20); // Completo, Cuota, Abono
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
