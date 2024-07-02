<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Coordenacao;
use App\Models\Servidor;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $servicos = Servico::all();
        foreach ($servicos as $servico) {
            $servico->nome_chefe = Servidor::find($servico->chefe)->nome;
        }

        return view('servicos.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coordenacoes = Coordenacao::all();
        return view('servicos.create',compact('coordenacoes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $servico = new Servico;
        $servico->nome = $request->input('nome');
        $servico->sigla = $request->input('sigla');
        $servico->chefe = $request->input('chefe');
        $servico->coordenacao_id = $request->input('coordenacao_id');

        $servico->save();
        return redirect()->route('servicos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        return view('servicos.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        $coordenacoes = Coordenacao::all();
        return view('servicos.edit', compact('servico','coordenacoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $servico->update($request->all());
        return redirect()->route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();
        return redirect()->route('servicos.index');
    }
}
