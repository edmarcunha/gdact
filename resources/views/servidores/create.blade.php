@extends('layouts.app')

@section('content')
    
    <h1>Novo Servidor</h1>

    <form action="{{ route('servidores.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </div>

        <div>
            <label for="siape">Siape:</label>
            <input type="text" name="siape" id="siape">
        </div>

        <div>
            <label for="login">Login:</label>
            <input type="text" name="login" id="login">
        </div>

        <div>
            <label for="coordenacao_id">Coordenação:</label>
            <select id="coordenacao_id" name="coordenacao_id" required>
                <option value="">Selecione a Coordenação</option>
                @foreach($coordenacoes as $coordenacao)
                    <option value="{{ $coordenacao->id }}">{{ $coordenacao->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="servico_id">Serviço:</label>
            <select id="servico_id" name="servico_id" required>
                <option value="">Selecione o Serviço</option>
                @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ativo">Ativo:</label>
            <input type="checkbox" id="ativo" name="ativo">
        </div>

        <div>
            <label for="observacao">Observação:</label>
            <input type="text"id="observacao" name="observacao">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    
@endsection