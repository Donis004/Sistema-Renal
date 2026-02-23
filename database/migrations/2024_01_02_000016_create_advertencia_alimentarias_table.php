<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertencia_alimentarias', function (Blueprint $table) {
            $table->id('id_advertencia');
            $table->unsignedBigInteger('id_detectado');
            $table->text('mensaje');
            $table->enum('severidad', ['INFO', 'ADVERTENCIA', 'CRITICA']);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('id_detectado')
                ->references('id_detectado')
                ->on('alimento_detectados')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertencia_alimentarias');
    }
};
