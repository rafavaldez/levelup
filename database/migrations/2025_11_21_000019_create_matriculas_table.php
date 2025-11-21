<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();

            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->dateTime('fecha_matricula');

            $table->foreignId('usuario_registro_id')
                  ->constrained('users')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->decimal('monto_matricula', 10, 2)->default(0);
            $table->string('moneda', 3)->default('PEN');
            $table->string('estado', 20)->default('ACTIVA'); // ACTIVA, CANCELADA, CERRADA
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
