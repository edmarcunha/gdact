@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Notas</h1>
        <a href="{{ route('notas.create') }}" class="btn btn-primary">Criar Nota</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Avaliação Servidor</th>
                    <th>Nota</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notas as $nota)
                    <tr>
                        <td>{{ $nota->id }}</td>
                        <td>{{ $nota->pergunta->questao }}</td>
                        <td>{{ $nota->avaliacaoServidor->id }}</td>
                        <td>{{ $nota->nota }}</td>
                        <td>
                            <a href="{{ route('notas.show', $nota->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection