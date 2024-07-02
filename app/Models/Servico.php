<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    protected $fillable = ['nome', 'sigla', 'chefe', 'coordenacao_id'];

    public function coordenacao()
    {
        // return $this->belongsTo(Coordenacao::class);
        return $this->belongsTo(Coordenacao::class, 'coordenacao_id');
    }

    public function chefe()
    {
        return $this->belongsTo(Servidor::class, 'chefe', 'id');
    }

}
