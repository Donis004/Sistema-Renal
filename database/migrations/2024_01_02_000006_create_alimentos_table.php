<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->id('id_alimento');
            $table->string('nombre', 150);
            $table->integer('potasio_mg')->nullable();
            $table->integer('fosforo_mg')->nullable();
            $table->integer('sodio_mg')->nullable();
            $table->decimal('proteina_g', 5, 2)->nullable();
            $table->string('porcion_estandar', 50)->nullable();
            $table->boolean('seguro_renal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alimentos');
    }
};
