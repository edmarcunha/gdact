@extends('layouts.app')

@section('content')
    
    <h1>Novo Serviço</h1>

    <form action="{{ route('servicos.store') }}" method="POST">
        @csrf

        <div>
            <label for="coordenacao_id">Coordenação:</label>
            <select class="form-control" id="coordenacao_id" name="coordenacao_id" required>
                <option value="">Selecione a Coordenação</option>
                    @foreach($coordenacoes as $coordenacao)
                        <option value="{{ $coordenacao->id }}">{{ $coordenacao->nome }}</option>
                    @endforeach
            </select>
        </div>

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </div>

        <div>
            <label for="sigla">Sigla:</label>
            <input type="text" name="sigla" id="sigla">
        </div>

        <div>
            <label for="chefe">Chefe:</label>
            <input type="text" name="chefe" id="chefe">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    
@endsection