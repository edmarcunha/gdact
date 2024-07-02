@extends('layouts.app')

@section('content')
    <h1>Detalhes do Serviço</h1>

    <p><strong>Nome:</strong> {{ $servico->nome }}</p>
    <p><strong>Sigla:</strong> {{ $servico->sigla }}</p>
    <p><strong>Chefe:</strong> {{ $servico->chefe }}</p>
    <p><strong>Coordenação ID:</strong> {{ $servico->coordenacao_id }}</p>

    <a href="{{ route('servicos.edit', $servico) }}" class="btn btn-primary">Editar</a>

@endsection