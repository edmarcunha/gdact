<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = [
        'ano_referencia',
        'inicio_periodo_avaliado',
        'fim_periodo_avaliado',
        'responsavel_1',
        'responsavel_2',
        'finalizada',
    ];

    protected $casts = [
        'finalizada' => 'boolean',
    ];

}
