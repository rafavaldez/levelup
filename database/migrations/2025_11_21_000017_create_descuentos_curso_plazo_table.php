<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('descuentos_curso_plazo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')
                  ->constrained('cursos')
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->unsignedInteger('meses'); // 3, 12, etc.
            $table->decimal('precio_promocional_total', 10, 2);
            $table->date('fecha_inicio_vigencia');
            $table->date('fecha_fin_vigencia')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->unique(
                ['curso_id', 'meses', 'fecha_inicio_vigencia'],
                'desc_curso_plazo_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('descuentos_curso_plazo');
    }
};
