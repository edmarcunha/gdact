<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\AvaliacaoServidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::all();
        return view('notas.index', compact('notas'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        $avaliacao_servidor_id = $request->avaliacao_id;
        $notas = $request->notas ?? [];
        $peso = $request->peso;

        $validator = Validator::make($request->all(), [
            'avaliacao_id' => 'required|exists:avaliacoes_servidores,id',
            'notas.*' => 'required|integer|min:1|max:5',
        ]);

        if (count($notas) == 0) {
            return redirect()->back()->with('error', 'Você deve fornecer pelo menos uma nota.');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with();
        }
        
        foreach ($notas as $perguntaId => $nota) {
            Nota::create([
                'pergunta_id' => $perguntaId,
                'avaliacao_servidor_id' => $avaliacao_servidor_id,
                'nota' => $nota,
            ]);
        }

        $qtdNotas = count(Nota::getNotasAvaliacao($avaliacao_servidor_id));
        if ($peso == '0.6' && $qtdNotas == 26) {
            // Atualiza a tabela avaliacoes_servidores para marcar avaliação como FEITA
            AvaliacaoServidor::where('id', $avaliacao_servidor_id)
                             ->update(['check' => 1]);
        } else if ($peso == '0.25' && $qtdNotas == 25) {
            // Atualiza a tabela avaliacoes_servidores para marcar avaliação como FEITA
            AvaliacaoServidor::where('id', $avaliacao_servidor_id)
                             ->update(['check' => 1]);
        }

        // Atualiza a tabela avaliacoes_servidores para marcar avaliação como FEITA
        // AvaliacaoServidor::where('id', $avaliacao_servidor_id)
        //                  ->update(['check' => 1]);

        return redirect()->back()
            ->with('success', 'Salvo com sucesso.');

    }

    public function show(Nota $nota)
    {
        return view('notas.show', compact('nota'));
    }

    public function edit(Nota $nota)
    {
        return view('notas.edit', compact('nota'));
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'pergunta_id' => 'required|exists:perguntas,id',
            'avaliacao_servidor_id' => 'required|exists:avaliacoes_servidores,id',
            'nota' => 'required|integer|min:1|max:5',
        ]);

        $nota->update($request->all());

        return redirect()->route('notas.index')
            ->with('success', 'Nota atualizada com sucesso.');
    }

    public function destroy(Nota $nota)
    {
        // Guardar o avaliacao_servidor_id antes de deletar
        $avaliacao_servidor_id = $nota->avaliacao_servidor_id;

        $nota->delete();

        AvaliacaoServidor::where('id', $avaliacao_servidor_id)
                        ->update(['check' => 0]);

        return redirect()->route('notas.index')
            ->with('success', 'Nota deletada com sucesso.');
    }
    
}
