<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Competencia;

class PerguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perguntas = Pergunta::with('competencia')->get();
        return view('perguntas.index', compact('perguntas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $competencias = Competencia::all();
        return view('perguntas.create', compact('competencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'competencia_id' => 'required|exists:competencias,id',
            'questao' => 'required|string|max:255',
        ]);

        Pergunta::create($validated);

        return redirect()->route('perguntas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pergunta $pergunta)
    {
        //
        return view('perguntas.show', compact('pergunta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pergunta $pergunta)
    {
        $competencias = Competencia::all();
        return view('perguntas.edit', compact('pergunta', 'competencias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pergunta $pergunta)
    {
        $validated = $request->validate([
            'competencia_id' => 'required|exists:competencias,id',
            'questao' => 'required|string|max:255',
        ]);

        $pergunta->update($validated);

        return redirect()->route('perguntas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pergunta $pergunta)
    {
        //
        $pergunta->delete();
        return redirect()->route('perguntas.index')
                         ->with('success', 'Pergunta deletada com sucesso.');
    }
}
