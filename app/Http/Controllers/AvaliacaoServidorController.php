<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoServidor;
use App\Models\Pergunta;
use App\Models\Competencia;
use App\Models\Nota;
use Illuminate\Http\Request;

class AvaliacaoServidorController extends Controller
{
    public function getAvaliacoes(int $id)
    {
        $avaliacoes = AvaliacaoServidor::where('id_servidor_avaliador', $id)->get();

        return compact('avaliacoes');
    }

    public function carregaAvaliacao(Request $request)
    {
        $idAvaliacao = $request->id;
        $dados_avaliacao = AvaliacaoServidor::with('avaliador', 'avaliado')->where('id', $idAvaliacao)->first();
        $perguntas = Pergunta::all();
        $competencias = Competencia::all();
        $notas = Nota::getNotasAvaliacao($idAvaliacao);

        return view('avaliacao_servidor.avaliacao', 
               compact(
                'idAvaliacao',
                'dados_avaliacao',
                'perguntas',
                'competencias',
                'notas',
                ));
    }
}
