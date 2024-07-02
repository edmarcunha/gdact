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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pergunta_id')->constrained('perguntas')->onDelete('cascade');
            $table->foreignId('avaliacao_servidor_id')->constrained('avaliacoes_servidores')->onDelete('cascade');
            $table->integer('nota')->unsigned()->check(function ($column) {
                return $column >= 1 && $column <= 5;
            });
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
