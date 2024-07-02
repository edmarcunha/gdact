@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Editar Pergunta</h1>

        <form action="{{ route('perguntas.update', $pergunta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="competencia_id">Competência</label>
                <select name="competencia_id" id="competencia_id" class="form-control">
                    @foreach($competencias as $competencia)
                        <option value="{{ $competencia->id }}" {{ $pergunta->competencia_id == $competencia->id ? 'selected' : '' }}>{{ $competencia->competencia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="questao">Questão</label>
                <input type="text" name="questao" id="questao" class="form-control" value="{{ $pergunta->questao }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

@endsection