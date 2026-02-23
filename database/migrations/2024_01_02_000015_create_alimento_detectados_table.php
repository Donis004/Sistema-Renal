<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alimento_detectados', function (Blueprint $table) {
            $table->id('id_detectado');
            $table->unsignedBigInteger('id_analisis');
            $table->string('nombre_detectado', 150)->nullable();
            $table->unsignedBigInteger('id_alimento')->nullable();
            $table->decimal('confianza', 5, 2)->nullable();
            $table->boolean('es_peligroso')->nullable();
            $table->text('motivo')->nullable();
            $table->timestamps();

            $table->foreign('id_analisis')
                ->references('id_analisis')
                ->on('analisis_imagenes')
                ->onDelete('cascade');

            $table->foreign('id_alimento')
                ->references('id_alimento')
                ->on('alimentos')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alimento_detectados');
    }
};
