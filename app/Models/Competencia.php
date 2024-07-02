<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'competencia',
        'descricao',
    ];

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }
}
