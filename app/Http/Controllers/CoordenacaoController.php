<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordenacao;
use App\Models\Servidor;

class CoordenacaoController extends Controller
{


    public function index()
    {
        $coordenacoes = Coordenacao::all();
        foreach ($coordenacoes as $coordenacao) {
            $coordenacao->nome_chefe = Servidor::find($coordenacao->chefe)->nome;
        }
        
        return view('coordenacoes.index', compact('coordenacoes'));
    }

    public function create()
    {
        return view('coordenacoes.create');
    }

    public function store(Request $request)
    {
        $coordenacao = new Coordenacao;
        $coordenacao->nome = $request->input('nome');
        $coordenacao->sigla = $request->input('sigla');
        $coordenacao->chefe = $request->input('chefe');

        $coordenacao->save();
        return redirect()->route('coordenacoes.index');
    }

    public function show(Coordenacao $coordenacao)
    {
        return view('coordenacoes.show', compact('coordenacao'));
    }

    public function edit(Coordenacao $coordenacao)
    {
        return view('coordenacoes.edit', compact('coordenacao'));
    }

    public function update(Request $request, Coordenacao $coordenacao)
    {
        $coordenacao->update($request->all());
        return redirect()->route('coordenacoes.index');
    }

    public function destroy(Coordenacao $coordenacao)
    {
        $coordenacao->delete();
        return redirect()->route('coordenacoes.index');
    }
}