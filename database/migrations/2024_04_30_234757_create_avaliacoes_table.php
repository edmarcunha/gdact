<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->year('ano_referencia');
            $table->date('inicio_periodo_avaliado');
            $table->date('fim_periodo_avaliado');
            $table->unsignedBigInteger('responsavel_1');
            $table->unsignedBigInteger('responsavel_2');
            $table->boolean('finalizada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
