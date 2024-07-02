<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoServidor extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes_servidores';

    protected $fillable = [
        'id_servidor_avaliador',
        'id_servidor_avaliado',
        'peso',
        'ano_referencia',
        'check',
    ];

    // Definindo a relação com a tabela servidores para o servidor avaliador
    public function avaliador()
    {
        return $this->belongsTo(Servidor::class, 'id_servidor_avaliador');
    }

    // Definindo a relação com a tabela servidores para o servidor avaliado
    public function avaliado()
    {
        return $this->belongsTo(Servidor::class, 'id_servidor_avaliado');
    }
    
}
