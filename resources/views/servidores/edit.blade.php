@extends('layouts.app')

@section('content')

    <h1>Editar Servidor</h1>

    <form action="{{ route('servidores.update', $servidor) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $servidor->nome }}" required>
        </div>

        <div>
            <label for="siape">Siape:</label>
            <input type="text" name="siape" id="siape" value="{{ $servidor->siape }}" required>
        </div>

        <div>
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" value="{{ $servidor->login }}" required> 
        </div>

        <div class="form-group">
            <label for="coordenacao_id">Coordenação:</label>
            <select class="form-control" id="coordenacao_id" name="coordenacao_id" required>
                @foreach($coordenacoes as $coordenacao)
                    <option value="{{ $coordenacao->id }}" {{ $coordenacao->id == $servidor->coordenacao_id ? 'selected' : '' }}>{{ $coordenacao->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="servico_id">Serviço:</label>
            <select class="form-control" id="servico_id" name="servico_id" required>
                @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}" {{ $servico->id == $servidor->servico_id ? 'selected' : '' }}>{{ $servico->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ativo">Ativo:</label>
            <input type="checkbox" id="ativo" name="ativo" value="1" {{ $servidor->ativo ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="observacao">Observação:</label>
            <textarea class="form-control" id="observacao" name="observacao">{{ $servidor->observacao }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    
@endsection