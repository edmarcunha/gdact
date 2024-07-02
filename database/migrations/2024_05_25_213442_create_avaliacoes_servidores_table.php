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
        Schema::create('avaliacoes_servidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servidor_avaliador');
            $table->unsignedBigInteger('id_servidor_avaliado');
            $table->float('peso', 3, 2);
            $table->year('ano_referencia');
            $table->boolean('check')->default(false);
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_servidor_avaliador')->references('id')->on('servidores')->onDelete('cascade');
            $table->foreign('id_servidor_avaliado')->references('id')->on('servidores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_servidores');
    }
};
