@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Nota {{ $nota->id }}</h1>
        <p><strong>Pergunta:</strong> {{ $nota->pergunta->questao }}</p>
        <p><strong>Avaliação Servidor:</strong> {{ $nota->avaliacaoServidor->id }}</p>
        <p><strong>Nota:</strong> {{ $nota->nota }}</p>
        <a href="{{ route('notas.index') }}" class="btn btn-primary">Voltar</a>
    </div>

@endsection