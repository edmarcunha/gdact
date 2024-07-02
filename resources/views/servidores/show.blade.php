@extends('layouts.app')

@section('content')

    <h1>Detalhes do Servidor</h1>

    <p><strong>Nome:</strong> {{ $servidor->nome }}</p>
    <p><strong>Siape:</strong> {{ $servidor->siape }}</p>
    <p><strong>Login:</strong> {{ $servidor->login }}</p>
    <p><strong>Serviço:</strong> {{ $servidor->servico_id }}</p>
    <p><strong>Coordenação:</strong> {{ $servidor->coordenacao_id }}</p>

    <a href="{{ route('servidores.edit', $servidor) }}" class="btn btn-primary">Editar</a>

@endsection