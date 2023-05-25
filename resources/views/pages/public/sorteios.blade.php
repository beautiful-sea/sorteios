@extends('layouts.app')

@section('content')

    <div id="app">
        <public-sorteios-listar></public-sorteios-listar>

        <div class="app-perguntas">
            <div class="app-title"><h1>🤷 Perguntas frequentes</h1>
            </div>
            <div id="perguntas-box">
                @foreach($perguntas_frequentes as $perguntas_frequente)
                    <div class="mb-2" style="cursor: pointer;">
                        <div class="pergunta-item d-flex flex-column p-2 bg-card box-shadow-08 rounded-10 font-weight-500 font-xs">
                            <div class="pergunta-item--pergunta" data-bs-toggle="collapse" data-bs-target="#pergunta-3"
                                 aria-expanded="false" aria-controls="pergunta-3"><i
                                        class="bi bi-arrow-right me-2 text-cor-primaria"></i>
                                <span>{{$perguntas_frequente->pergunta}}												</span>
                            </div>
                            <div class="d-block">
                                <div class="pergunta-item--resp collapse mt-1 text-muted" id="pergunta-3"
                                     data-bs-parent="#perguntas-box">
                                    <p>
                                        {{$perguntas_frequente->resposta}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
