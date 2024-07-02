@extends('layouts.app')

@section('content')

    <h1>Ver Competência</h1>
    <p><strong>Competência:</strong> {{ $competencia->competencia }}</p>
    <p><strong>Descrição:</strong> {{ $competencia->descricao }}</p>
    <a href="{{ route('competencias.index') }}" class="btn btn-primary">Voltar</a>

@endsection