<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competencia;

class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $competencias = Competencia::all();
        return view('competencias.index', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('competencias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'competencia' => 'required|string',
            'descricao' => 'required|string',
        ]);

        Competencia::create($request->all());
        return redirect()->route('competencias.index')
                         ->with('success', 'Competência criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competencia $competencia)
    {
        //
        return view('competencias.show', compact('competencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competencia $competencia)
    {
        //
        return view('competencias.edit', compact('competencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competencia $competencia)
    {
        //
        $request->validate([
            'competencia' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $competencia->update($request->all());
        return redirect()->route('competencias.index')
                         ->with('success', 'Competência atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competencia $competencia)
    {
        //
        $competencia->delete();
        return redirect()->route('competencias.index')
                         ->with('success', 'Competência deletada com sucesso.');
    }
}
