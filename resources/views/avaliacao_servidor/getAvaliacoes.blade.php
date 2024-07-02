
@section('avaliacoes_a_fazer')   
    
    <form method="GET" action="{{ route('home') }}">
        <div class="mb-3">
            <label for="id_servidor_avaliador" class="form-label">ID Avaliador:</label>
            <input type="text" id="id_servidor_avaliador" class="form-control" name="id_servidor_avaliador" value="{{ $avaliadorId }}">
            <br/>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <h2>Avaliações</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Avaliador</th>
                <th>Avaliado</th>
                <th>Peso</th>
                <th>Ano</th>
                <th>Check</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avaliacoes as $avaliacao)
                <tr>
                    <td>{{ $avaliacao->avaliador->nome }}</td>
                    <td>{{ $avaliacao->avaliado->nome }}</td>
                    <td>{{ $avaliacao->peso }}</td>
                    <td>{{ $avaliacao->ano_referencia }}</td>
                    <td>{{ $avaliacao->check ? 'Sim' : 'Não' }}</td>
                    <td>
                        @if($avaliacao->check)
                            <a href="#" class="btn btn-primary disabled" role="button" aria-disabled="true">Avaliado</a>
                        @else
                            <a href="{{ route('avaliacao_servidor.avaliacao', $avaliacao->id) }}" class="btn btn-primary">Avaliar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection