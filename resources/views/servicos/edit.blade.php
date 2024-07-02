@extends('layouts.app')

@section('content')

    <h1>Editar Serviço</h1>

    <form action="{{ route('servicos.update', $servico) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $servico->nome }}">
        </div>

        <div>
            <label for="sigla">Sigla:</label>
            <input type="text" name="sigla" id="sigla" value="{{ $servico->sigla }}">
        </div>

        <div>
            <label for="chefe">Chefe:</label>
            <input type="text" name="chefe" id="chefe" value="{{ $servico->chefe }}">
        </div>

        <div>
            <label for="coordenacao_id">Coordenação ID:</label>
            <input type="number" name="coordenacao_id" id="coordenacao_id" value="{{ $servico->coordenacao_id }}">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

@endsection