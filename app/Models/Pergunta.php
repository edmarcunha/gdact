<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'competencia_id', // chave estrangeira
        'questao',
    ];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class);
    }
}
