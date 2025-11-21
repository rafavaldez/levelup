<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 10)->nullable();
            $table->string('numero_documento', 20)->nullable();
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->string('estado', 20)->default('ACTIVO');
            $table->timestamps();

            $table->unique(['tipo_documento', 'numero_documento'], 'clientes_doc_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
