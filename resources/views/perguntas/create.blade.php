@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Criar Pergunta</h1>

        <form action="{{ route('perguntas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="competencia_id">Competência</label>
                <select name="competencia_id" id="competencia_id" class="form-control">
                    @foreach($competencias as $competencia)
                        <option value="{{ $competencia->id }}">{{ $competencia->competencia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="questao">Questão</label>
                <input type="text" name="questao" id="questao" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

@endsection