@extends('layouts.app')

@section('content')
    <h1 class="mt-5">Painel</h1>

    <ul class="list-group mt-3">
        <li class="list-group-item"><a href="{{ route('avaliacao.index') }}">Gerenciar Avaliações</a></li>
        <li class="list-group-item"><a href="{{ route('coordenacoes.index') }}">Gerenciar Coordenações</a></li>
        <li class="list-group-item"><a href="{{ route('servicos.index') }}">Gerenciar Serviços</a></li>
        <li class="list-group-item"><a href="{{ route('servidores.index') }}">Gerenciar Servidores</a></li>
        <li class="list-group-item"><a href="{{ route('perguntas.index') }}">Gerenciar Perguntas</a></li>
        <li class="list-group-item"><a href="{{ route('competencias.index') }}">Gerenciar Competências</a></li>
        <li class="list-group-item"><a href="{{ route('notas.index') }}">Gerenciar Notas</a></li>
    </ul>
@endsection