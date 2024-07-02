@extends('layouts.app')

@section('content')

    <h1>Criar Competência</h1>
    <form action="{{ route('competencias.store') }}" method="POST">
        @csrf
        <label>Competência:</label>
        <input type="text" name="competencia" required>
        <label>Descrição:</label>
        <input type="text" name="descricao" required>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection