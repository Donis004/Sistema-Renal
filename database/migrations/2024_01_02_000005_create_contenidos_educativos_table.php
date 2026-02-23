<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contenidos_educativos', function (Blueprint $table) {
            $table->id('id_contenido');
            $table->string('titulo', 150)->nullable();
            $table->string('etapa_erc', 10)->nullable();
            $table->enum('tipo', ['DIETA', 'LIQUIDOS', 'EJERCICIO'])->nullable();
            $table->text('contenido')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenidos_educativos');
    }
};
