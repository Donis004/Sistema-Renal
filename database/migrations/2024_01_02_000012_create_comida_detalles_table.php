<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comida_detalles', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_comida');
            $table->unsignedBigInteger('id_alimento');
            $table->decimal('cantidad_porcion', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_comida')
                ->references('id_comida')
                ->on('comidas')
                ->onDelete('cascade');

            $table->foreign('id_alimento')
                ->references('id_alimento')
                ->on('alimentos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comida_detalles');
    }
};
