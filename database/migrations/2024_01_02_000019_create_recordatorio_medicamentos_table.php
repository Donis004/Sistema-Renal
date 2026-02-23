<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recordatorio_medicamentos', function (Blueprint $table) {
            $table->id('id_recordatorio');
            $table->unsignedBigInteger('id_pm');
            $table->time('hora')->nullable();
            $table->boolean('tomado')->default(false);
            $table->date('fecha')->nullable();
            $table->timestamps();

            $table->foreign('id_pm')
                ->references('id_pm')
                ->on('paciente_medicamentos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recordatorio_medicamentos');
    }
};
