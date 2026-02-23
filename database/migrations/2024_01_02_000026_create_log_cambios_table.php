<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_cambios', function (Blueprint $table) {
            $table->id('id_log');
            $table->string('tabla_afectada', 50)->nullable();
            $table->integer('id_registro')->nullable();
            $table->enum('accion', ['INSERT', 'UPDATE', 'DELETE'])->nullable();
            $table->unsignedBigInteger('realizado_por')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('realizado_por')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_cambios');
    }
};
