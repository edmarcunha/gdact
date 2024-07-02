@extends('layouts.app')

@section('content')

    <h1>Competências</h1>
    <a href="{{ route('competencias.create') }}">Nova Competência</a>
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    <table>
        <tr>
            <th>Competência</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        @foreach ($competencias as $competencia)
        <tr>
            <td>{{ $competencia->competencia }}</td>
            <td>{{ $competencia->descricao }}</td>
            <td>
                <a href="{{ route('competencias.show', $competencia->id) }}" class="btn btn-primary">Ver</a>
                <a href="{{ route('competencias.edit', $competencia->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('competencias.destroy', $competencia->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection