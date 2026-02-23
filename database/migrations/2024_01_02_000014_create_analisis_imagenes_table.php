<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analisis_imagenes', function (Blueprint $table) {
            $table->id('id_analisis');
            $table->unsignedBigInteger('id_foto');
            $table->enum('estado', ['PENDIENTE', 'ANALIZADO', 'ERROR'])->default('PENDIENTE');
            $table->enum('nivel_riesgo', ['BAJO', 'MEDIO', 'ALTO'])->nullable();
            $table->text('observacion_general')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('id_foto')
                ->references('id_foto')
                ->on('foto_comidas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analisis_imagenes');
    }
};
