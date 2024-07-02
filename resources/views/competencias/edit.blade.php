@extends('layouts.app')

@section('content')

    <h1>Editar Competência</h1>
    <form action="{{ route('competencias.update', $competencia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Competência:</label>
        <input type="text" name="competencia" value="{{ $competencia->competencia }}" required>
        <label>Descrição:</label>
        <input type="text" name="descricao" value="{{ $competencia->descricao }}" required>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection