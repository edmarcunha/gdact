@extends('layouts.app')

@section('content')
    <h1>Lista de Coordenações</h1>
    <p><a href="{{ route('coordenacoes.create') }}" class="btn btn-info">Adicionar Nova Coordenação</a></p>
    <p><a href="{{ route('painel') }}" class="btn btn-info">Voltar ao Painel</a></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Chefe</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coordenacoes as $coordenacao)
                <tr>
                    <td>{{ $coordenacao->id }}</td>
                    <td>{{ $coordenacao->nome }}</td>
                    <td>{{ $coordenacao->sigla }}</td>
                    <td>{{ $coordenacao->nome_chefe }}</td>
                    <td>
                        <a href="{{ route('coordenacoes.edit', $coordenacao->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('coordenacoes.destroy', $coordenacao->id) }}" method="POST" style="display:inline-block;">
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
