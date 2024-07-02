@extends('layouts.app')

@section('content')

    <h1>Serviços</h1>

    <p><a href="{{ route('servicos.create') }}" class="btn btn-info">Novo Serviço</a></p>
    <p><a href="{{ route('painel') }}" class="btn btn-info">Voltar ao Painel</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Chefe</th>
                <th>Coordenação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicos as $servico)
                <tr>
                    <td>{{ $servico->id }}</td>
                    <td>{{ $servico->nome }}</td>
                    <td>{{ $servico->sigla }}</td>
                    <td>{{ $servico->nome_chefe }}</td>
                    <td>{{ $servico->coordenacao->nome }}</td>
                    <td>
                        <a href="{{ route('servicos.edit', $servico->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" style="display:inline-block;">
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