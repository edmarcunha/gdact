@extends('layouts.app')

@section('content')

    @php
        // Organizar perguntas por competência
        $perguntasPorCompetencia = [];
        foreach ($perguntas as $pergunta) {
            $perguntasPorCompetencia[$pergunta->competencia_id][] = $pergunta;
        }
    @endphp

    <p>Você está avaliando o servidor: {{ $dados_avaliacao->avaliado->nome }}</p>
    <p>Período de avaliação: {{ $dados_avaliacao->ano_referencia }}</p>
    <!-- <p>Id avaliação: {{ $dados_avaliacao->id }}</p> -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="accordion" id="accordionExample">
        @foreach($competencias as $competencia)

            <!-- VERIFICA SE O BLOCO DA COMPETÊNCIA IMI SERÁ EXIBIDO -->
            @if($competencia->id == 6 && $dados_avaliacao->peso != 0.6)
                @continue 
            @endif
            <!-- END -->

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $competencia->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $competencia->id }}" aria-expanded="false" aria-controls="collapse{{ $competencia->id }}">
                        {{ $competencia->competencia }} 
                    </button>
                </h2>
                <div id="collapse{{ $competencia->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $competencia->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @if(isset($perguntasPorCompetencia[$competencia->id]))
                            <form method="POST" action="{{ route('notas.store') }}">
                                @csrf
                                <input type="hidden" name="avaliacao_id" value="{{ $dados_avaliacao->id }}"> <!-- INPUT HIDDEN PASSANDO ID DA AVALIAÇÃO -->
                                <input type="hidden" name="competencia" value="{{ $competencia->competencia }}"> <!-- INPUT HIDDEN PASSANDO A COMPETÊNCIA -->
                                <input type="hidden" name="peso" value="{{ $dados_avaliacao->peso }}"> <!-- INPUT HIDDEN PASSANDO O PESO -->
                                @foreach($perguntasPorCompetencia[$competencia->id] as $pergunta)
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <strong>{{ $pergunta->questao }}</strong>
                                        </div>
                                        @php
                                            $nota = $notas->firstWhere('pergunta_id', $pergunta->id);
                                            $isDisabled = $nota ? 'disabled' : '';
                                        @endphp
                                        <div class="col-12 col-md-4">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                @for ($i = 1; $i <= 5; $i++)
                                                     @php
                                                        $isChecked = $nota && $nota->nota == $i;
                                                    @endphp
                                                    <input 
                                                        type="radio" 
                                                        class="btn-check" 
                                                        name="notas[{{ $pergunta->id }}]" 
                                                        id="option{{ $i }}_{{ $pergunta->id }}" 
                                                        autocomplete="off" value="{{ $i }}" 
                                                        {{ $isChecked ? 'checked' : '' }} 
                                                        {{ $isDisabled }}
                                                    >
                                                    <label class="btn btn-outline-primary" for="option{{ $i }}_{{ $pergunta->id }}">{{ $i }}</label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mb-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Enviar Respostas</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p>Sem perguntas para essa competência.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div>
            <a class="btn btn-primary" href="{{ route('home') }}">Voltar</a>
        </div>
    </div>

@endsection