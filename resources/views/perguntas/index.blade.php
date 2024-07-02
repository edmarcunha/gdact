@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Lista de Perguntas</h1>
        <a href="{{ route('perguntas.create') }}" class="btn btn-primary mb-3">Adicionar Pergunta</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Competência</th>
                    <th>Questão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($perguntas as $pergunta)
                    <tr>
                        <td>{{ $pergunta->competencia->id }}</td>
                        <td>{{ $pergunta->questao }}</td>
                        <td>
                            <a href="{{ route('perguntas.edit', $pergunta) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('perguntas.destroy', $pergunta) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection