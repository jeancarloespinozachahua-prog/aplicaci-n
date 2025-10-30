<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Crea la tabla 'solicitud_soportes' con todos los campos necesarios.
     */
    public function up(): void
    {
        Schema::create('solicitud_soportes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dni');
            $table->string('asunto');
            $table->text('mensaje');
            $table->string('archivo')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla 'solicitud_soportes' si se revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_soportes');
    }
};
