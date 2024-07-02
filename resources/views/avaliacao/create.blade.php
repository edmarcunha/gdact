@extends('layouts.app')

@section('content')
    <h1>Nova Avaliação</h1>

    <form action="{{ route('avaliacao.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ano_referencia">Ano Referência:</label>
            <input type="number" class="form-control" id="ano_referencia" name="ano_referencia" min='2020' max={{ $anoAtual }}>
            <br>
            <label for="inicio_periodo_avaliado">Inicio:</label>
            <input type="date" placeholder="dd-mm-aaaa" class="form-control" id="inicio_periodo_avaliado" name="inicio_periodo_avaliado">
            <br>
            <label for="fim_periodo_avaliado">Fim:</label>
            <input type="date" placeholder="dd-mm-aaaa" class="form-control" id="fim_periodo_avaliado" name="fim_periodo_avaliado">
            <br>
            <label for="responsavel_1">1º Responsável:</label>
            <input type="text" class="form-control" id="responsavel_1" name="responsavel_1">
            <br>
            <label for="responsavel_2">2º Responsável:</label>
            <input type="text" class="form-control" id="responsavel_2" name="responsavel_2">
        </div>
        <!-- Adicione os campos restantes do formulário aqui -->
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
