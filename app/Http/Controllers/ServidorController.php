<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servidor;
use App\Models\Coordenacao;
use App\Models\Servico;

class ServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $servidores = Servidor::all();
        $servidores = Servidor::with(['coordenacao', 'servico'])->get();
        return view('servidores.index', compact('servidores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coordenacoes = Coordenacao::all();
        $servicos = Servico::all();
        return view('servidores.create', compact('coordenacoes', 'servicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $servidor = new Servidor;
        $servidor->nome = $request->input('nome');
        $servidor->siape = $request->input('siape');
        $servidor->login = $request->input('login');
        $servidor->coordenacao_id = $request->input('coordenacao_id');
        $servidor->servico_id = $request->input('servico_id');
        $servidor->ativo = $request->input('ativo') ? 1 : 0; // Checkbox value
        $servidor->observacao = $request->input('observacao');
        $servidor->save();

        return redirect()->route('servidores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servidor $servidor)
    {
        return view('servidores.show', compact('servidor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servidor $servidor)
    {
        $coordenacoes = Coordenacao::all();
        $servicos = Servico::all();
        return view('servidores.edit', compact('servidor', 'coordenacoes', 'servicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servidor $servidor)
    {
        $servidor->update($request->all());
        return redirect()->route('servidores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servidor $servidor)
    {
        $servidor->delete();
        return redirect()->route('servidores.index');
    }
}
