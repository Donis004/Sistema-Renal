<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_comidas', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_comida');
            $table->string('url_imagen', 255);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('id_comida')
                ->references('id_comida')
                ->on('comidas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_comidas');
    }
};
