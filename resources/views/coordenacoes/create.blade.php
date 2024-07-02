@extends('layouts.app')

@section('content')

    <h1>Criar Nova Coordenação</h1>
    <form action="{{ route('coordenacoes.store') }}" method="POST">
        @csrf
        Nome: <input type="text" name="nome"><br>
        Sigla: <input type="text" name="sigla"><br>
        Chefe: <input type="text" name="chefe"><br>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection
