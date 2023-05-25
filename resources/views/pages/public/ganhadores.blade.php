@extends('layouts.app')

@section('content')
    <div class="app-ganhadores mb-2 ">
        <div class="col-12">
            <div class="app-title"><h1>🎉 Ganhadores</h1>
                <div class="app-title-desc">sortudos
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                @forelse($ganhadores as $ganhador)
                    <div class="col-12">
                        <div class="ganhadorItem_ganhadorContainer__1Sbxm mb-2">
                            <div class="ganhadorItem_ganhadorFoto__324kH box-shadow-08">
                                <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                    <i style="font-size: 2em; text-align: center; width: 100%; padding-top: 10px; color: green;"
                                       class="fa fa-user-circle"></i>
                                </div>
                            </div>
                            <div class="undefined w-100"><h3 class="ganhadorItem_ganhadorNome__2j_J-">{{$ganhador->nome_cliente}}
                                    </h3>
                                <p class="ganhadorItem_ganhadorDescricao__Z4kO2">Ganhou <b>{{$ganhador->rifa->titulo}}</b>
                                    número {{$ganhador->rifa->numero_sorteado_formatado}}</p>
                            </div>
                            <div>
                                <div class="rounded-pill"
                                     style="width:40px;height:40px;position:relative;overflow:hidden">
                                    <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                        <img alt="{{$ganhador->rifa->titulo}}"
                                             src="/storage/{{$ganhador->rifa->imagem_principal->path}}"
                                             decoding="async" data-nimg="fill"
                                             style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <h4 class="alert-heading">Ops!</h4>
                            <p>Não há ganhadores ainda.</p>
                            <hr>
                            <p class="mb-0">Aguarde o sorteio.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
@endsection
