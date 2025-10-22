<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración: crea la tabla enfermedades.
     */
    public function up(): void
    {
       Schema::create('enfermedades', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->text('descripcion');
    $table->text('sintomas')->nullable();
    $table->timestamps();
});

    }

    /**
     * Revierte la migración: elimina la tabla enfermedades.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermedades');
    }
};
