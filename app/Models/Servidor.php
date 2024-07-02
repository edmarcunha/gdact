<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $table = 'servidores';

    protected $fillable = ['siape', 'nome', 'login', 'coordenacao_id', 'servico_id'];

    public function coordenacao()
    {
        // return $this->belongsTo(Coordenacao::class);
        return $this->belongsTo(Coordenacao::class, 'coordenacao_id');
        // return $this->hasOne(Coordenacao::class, 'chefe', 'id');
    }

    public function servico()
    {
        // return $this->belongsTo(Servico::class);
        return $this->belongsTo(Servico::class, 'servico_id');
    }

    public static function getServidoresDiretoria($diretor)
    {
        return static::where('coordenacao_id', 2)
        ->where('servico_id', 2)
        ->where('ativo', 1)
        ->where('id', '!=', $diretor)
        ->with(['coordenacao', 'servico'])
        ->get();
    }

}
