@extends('layouts.app')

@section('content')

    <h1>Avaliação #{{ $avaliacao->id }}</h1>

    <p><strong>Ano Referência:</strong> {{ $avaliacao->ano_referencia }}</p>
    <p><strong>Inicio:</strong> {{ date('d/m/Y', strtotime($avaliacao->inicio_periodo_avaliado)) }}</p>
    <p><strong>Fim:</strong> {{ date('d/m/Y', strtotime($avaliacao->fim_periodo_avaliado)) }}</p>
    <p><strong>1º Responsável:</strong> {{ $avaliacao->responsavel_1 }}</p>
    <p><strong>2º Responsável:</strong> {{ $avaliacao->responsavel_2 }}</p>
    <p><strong>Finalizada:</strong> {{ $avaliacao->finalizada ? 'Sim' : 'Não' }}</p>
    <!-- Adicione os campos restantes da avaliação aqui -->

    <a href="{{ route('avaliacao.edit', $avaliacao->id) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('avaliacao.index') }}" class="btn btn-primary">Voltar</a>
    <!-- Adicione o formulário de exclusão aqui, se necessário -->

@endsection