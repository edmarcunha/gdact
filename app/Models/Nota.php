<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'pergunta_id',
        'avaliacao_servidor_id',
        'nota',
    ];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function avaliacaoServidor()
    {
        return $this->belongsTo(AvaliacaoServidor::class);
    }

    public static function getNotasAvaliacao($id)
    {
        return self::where('avaliacao_servidor_id', $id)->get();
    }
}
