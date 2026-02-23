<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_detalles', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_menu');
            $table->enum('dia', ['LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB', 'DOM']);
            $table->enum('tiempo_comida', ['DESAYUNO', 'COMIDA', 'CENA']);
            $table->unsignedBigInteger('id_alimento');
            $table->timestamps();

            $table->foreign('id_menu')
                ->references('id_menu')
                ->on('menu_semanales')
                ->onDelete('cascade');

            $table->foreign('id_alimento')
                ->references('id_alimento')
                ->on('alimentos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_detalles');
    }
};
