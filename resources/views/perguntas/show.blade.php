@extends('layouts.app')

@section('content')

    <h1>Ver Pergunta</h1>
    <p><strong>Competência:</strong> {{ $pergunta->competencia }}</p>
    <p><strong>Descrição:</strong> {{ $pergunta->descricao }}</p>
    <p><strong>Questão:</strong> {{ $pergunta->questao }}</p>
    <a href="{{ route('perguntas.index') }}">Voltar</a>

@endsection