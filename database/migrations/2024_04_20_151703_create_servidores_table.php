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
        Schema::create('servidores', function (Blueprint $table) {
            $table->id();
            $table->integer('siape');
            $table->string('nome');
            $table->string('login');
            $table->unsignedBigInteger('coordenacao_id');
            // $table->foreign('coordenacao_id')->references('id')->on('coordenacao');
            $table->unsignedBigInteger('servico_id');
            // $table->foreign('servico_id')->references('id')->on('servicos');
            $table->boolean('ativo')->default(0);
            $table->string('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidores');
    }
};
