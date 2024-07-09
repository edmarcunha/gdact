@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Avaliação GDACT') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Você tem avaliações por fazer.') }}

                        @include('avaliacao_servidor.getAvaliacoes')
                        @yield('avaliacoes_a_fazer')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
