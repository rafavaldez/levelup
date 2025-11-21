<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matricula_detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('matricula_id')
                  ->constrained('matriculas')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->foreignId('curso_id')
                  ->constrained('cursos')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->unsignedInteger('meses_contratados');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->decimal('precio_unitario_mensual', 10, 2);
            $table->foreignId('descuento_curso_plazo_id')
                  ->nullable()
                  ->constrained('descuentos_curso_plazo')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->decimal('precio_final', 10, 2);
            $table->string('estado', 20)->default('PENDIENTE'); // PENDIENTE, EN_CURSO, PAGADO, VENCIDO
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matricula_detalles');
    }
};
