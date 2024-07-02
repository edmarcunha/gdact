@extends('layouts.app')

@section('content')

    <h1>Servidores</h1>

    <p><a href="{{ route('servidores.create') }}" class="btn btn-primary">Novo Servidor</a></p>
    <p><a href="{{ route('painel') }}" class="btn btn-info">Voltar ao Painel</a></p>

    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>SIAPE</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Coordenação</th>
                <th>Serviço</th>
                <th>Ativo</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servidores as $servidor)
                <tr>
                    <td>{{ $servidor->id }}</td>
                    <td>{{ $servidor->siape }}</td>
                    <td>{{ $servidor->nome }}</td>
                    <td>{{ $servidor->login }}</td>
                    <td>{{ $servidor->coordenacao->sigla ?? 'N/A' }}</td>
                    <td>{{ $servidor->servico->sigla ?? 'N/A' }}</td>
                    <td>{{ $servidor->ativo ? 'Sim' : 'Não' }}</td>
                    <td>{{ $servidor->observacao }}</td>
                    <td>
                        <a href="{{ route('servidores.edit', $servidor->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('servidores.destroy', $servidor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection