@extends('layouts.app')

@section('content')

    <h1>Editar Avaliação #{{ $avaliacao->id }}</h1>

    <form action="{{ route('avaliacao.update', $avaliacao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ano_referencia">Ano Referência:</label>
            <input type="text" class="form-control" id="ano_referencia" name="ano_referencia" value="{{ $avaliacao->ano_referencia }}">
            <br>
            <label for="inicio_periodo_avaliado">Inicio:</label>
            <input type="date" placeholder="dd-mm-aaaa" class="form-control" id="inicio_periodo_avaliado" name="inicio_periodo_avaliado" value="{{ $avaliacao->inicio_periodo_avaliado }}">
            <br>
            <label for="fim_periodo_avaliado">Fim:</label>
            <input type="date" placeholder="dd-mm-aaaa" class="form-control" id="fim_periodo_avaliado" name="fim_periodo_avaliado" value="{{ $avaliacao->fim_periodo_avaliado }}">
            <br>
            <label for="responsavel_1">1º Responsável:</label>
            <input type="text" class="form-control" id="responsavel_1" name="responsavel_1" value="{{ $avaliacao->responsavel_1 }}">
            <br>
            <label for="responsavel_2">2º Responsável:</label>
            <input type="text" class="form-control" id="responsavel_2" name="responsavel_2" value="{{ $avaliacao->responsavel_2 }}">
            <br>
            <label for="finalizada">Finalizada:</label>
            <div>
                <input type="radio" id="finalizada_sim" name="finalizada" value="1" {{ $avaliacao->finalizada ? 'checked' : '' }}>
                <label for="finalizada_sim">Sim</label>

                <input type="radio" id="finalizada_nao" name="finalizada" value="0" {{ !$avaliacao->finalizada ? 'checked' : '' }}>
                <label for="finalizada_nao">Não</label>
            </div>
        </div>
        <!-- Adicione os campos restantes do formulário aqui -->
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>

@endsection
