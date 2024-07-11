
@section('avaliacoes_a_fazer')   

    <h2>Avaliações</h2>

    @foreach($avaliacoes as $ano => $avaliacoes)
        <div class="accordion mb-3" id="accordion{{ $ano }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $ano }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $ano }}" aria-expanded="true" aria-controls="collapse{{ $ano }}">
                        Avaliações de {{ $ano }}
                    </button>
                </h2>
                <div id="collapse{{ $ano }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $ano }}" data-bs-parent="#accordion{{ $ano }}">
                    <div class="accordion-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Avaliado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($avaliacoes as $avaliacao)
                                    <tr>
                                        <td>{{ $avaliacao->avaliado->nome }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection