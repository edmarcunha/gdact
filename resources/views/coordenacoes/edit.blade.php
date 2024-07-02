@extends('layouts.app')

@section('content')

    <h1>Editar Coordenação</h1>
    <form action="{{ route('coordenacoes.update', $coordenacao) }}" method="POST">
        @csrf
        @method('PUT')
        Nome: <input type="text" name="nome" value="{{ $coordenacao->nome }}"><br>
        Sigla: <input type="text" name="sigla" value="{{ $coordenacao->sigla }}"><br>
        Chefe: <input type="text" name="chefe" value="{{ $coordenacao->chefe }}"><br>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection
