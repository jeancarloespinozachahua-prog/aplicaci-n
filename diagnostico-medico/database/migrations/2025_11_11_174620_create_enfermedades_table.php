<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');              // Nombre de la enfermedad
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->enum('nivel_gravedad', ['leve', 'moderada', 'grave']); // Clasificación
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enfermedades');
    }
};
