@extends('layouts.app')

@section('content')

    <h1>Listagem de Avaliações</h1>

    <p><a href="{{ route('avaliacao.create') }}" class="btn btn-primary mb-3">Nova Avaliação</a></p>
    <p><a href="{{ route('painel') }}">Voltar ao Painel</a></p>

    @if ($avaliacoes->isEmpty())
        <p>Nenhuma avaliação encontrada.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ano Referência</th>
                    <th>Início Período Avaliado</th>
                    <th>Fim Período Avaliado</th>
                    <th>Responsável 1</th>
                    <th>Responsável 2</th>
                    <th>Finalizada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($avaliacoes as $avaliacao)
                    <tr>
                        <td>{{ $avaliacao->id }}</td>
                        <td>{{ $avaliacao->ano_referencia }}</td>
                        <td>{{ date('d/m/Y', strtotime($avaliacao->inicio_periodo_avaliado)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($avaliacao->fim_periodo_avaliado)) }}</td>
                        <td>{{ $avaliacao->nome_responsavel1 }}</td>
                        <td>{{ $avaliacao->nome_responsavel2 }}</td>
                        <td>{{ $avaliacao->finalizada ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href="{{ route('avaliacao.show', $avaliacao->id) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('avaliacao.edit', $avaliacao->id) }}" class="btn btn-primary">Editar</a>
                            <!-- Formulário de sortear -->
                            <form action="{{ route('avaliacoes.sortear') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="ano_referencia" value="{{ $avaliacao->ano_referencia }}">
                                <button type="submit" class="btn btn-primary">Sortear</button>
                            </form>
                            <!-- Formulário de sortear -->
                            
                            <!-- Adicione o formulário de exclusão aqui, se necessário -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection