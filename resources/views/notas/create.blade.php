@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Criar Nota</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pergunta_id">Pergunta</label>
                <input type="text" name="pergunta_id" class="form-control" value="{{ old('pergunta_id') }}">
            </div>
            <div class="form-group">
                <label for="avaliacao_servidor_id">Avaliação Servidor</label>
                <input type="text" name="avaliacao_servidor_id" class="form-control" value="{{ old('avaliacao_servidor_id') }}">
            </div>
            <div class="form-group">
                <label for="nota">Nota</label>
                <input type="number" name="nota" class="form-control" value="{{ old('nota') }}" min="1" max="5">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

@endsection