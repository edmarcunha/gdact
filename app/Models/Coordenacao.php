<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordenacao extends Model
{
    use HasFactory;
    
    protected $table = 'coordenacao';

    protected $fillable = ['nome', 'sigla', 'chefe'];

    public function chefe()
    {
        return $this->belongsTo(Servidor::class,'chefe', 'id');
    }
}
