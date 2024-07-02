@extends('layouts.app')

@section('content')

    <h1>Detalhes da Coordenação</h1>
    <p>Nome: {{ $coordenacao->nome }}</p>
    <p>Sigla: {{ $coordenacao->sigla }}</p>
    <p>Chefe: {{ $coordenacao->chefe }}</p>
    <a href="{{ route('coordenacoes.edit', $coordenacao) }}">Editar</a>
    <form action="{{ route('coordenacoes.destroy', $coordenacao) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Excluir</button>
    </form>

@endsection
