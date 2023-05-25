@extends('layouts.app')



@section('vendor-style')
@endsection
@section('page-style')
@endsection
@section('content')

    <div class="sorteio-header mb-2">

        <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR  pointer">

            <div class="SorteioTpl_imagemContainer__2-pl4 col-auto  blocoImagemSlide" style="padding: 0;">


                <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner blocoImagemSlide" style="height: 290px;">

                        @foreach($rifa->imagens as $key=>$imagem)
                            <div class="carousel-item {{$key === 0 ? 'active':''}}">
                                <img class="d-block w-100 imagemSlide"
                                     src="{{'/storage/'.$imagem->path}}"
                                     style="object-fit: cover; position: absolute; top: 0;">
                            </div>
                        @endforeach
                    </div>

                    @if(count($rifa->imagens) > 1)
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        @endif


                </div>


            </div>

            <div class="SorteioTpl_info__t1BZr">
                <h1 class="SorteioTpl_title__3RLtu">
                    {{$rifa->titulo}}
                </h1>
                <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">
                    {{$rifa->resumo}}
                </p>
                @if($rifa->status === 'EM_ANDAMENTO')
                <span class="badge bg-success blink bg-opacity-75 font-xsss" >Adquira já!</span>
                @elseif($rifa->status === 'EM_BREVE')
                <span class="badge bg-info blink bg-opacity-75 font-xsss"  >Em breve!</span>
                @else
                <span class="badge bg-dark blink bg-opacity-75 font-xsss"  >Concluído!</span>
                @endif
            </div>
        </div>
    </div>

    <div class="sorteio-preco porApenas font-xs d-flex align-items-center justify-content-center mb-2">

        <div class="item d-flex align-items-center">

            <div class="me-1 text-uppercase la_cor_texto_1">Por apenas
            </div>

            <div class="tag btn btn-sm bg-cor-primaria text-cor-primaria-link box-shadow-08 text-white">
                R$ {{number_format($rifa->valor_por_numero,2,',','.')}}
            </div>
        </div>
    </div>


    <div class="app-card card font-xs mb-2 sorteio_sorteioDesc__TBYaL">

        <div class="card-body sorteio_sorteioDescBody__3n4ko la_cor_3 la_cor_texto_1" style="overflow: auto;">

            {!! $rifa->descricao !!}

        </div>

    </div>

    @if($rifa->mostrar_data_sorteio)
    <div class="sorteio-share d-flex mb-2 justify-content-between align-items-center">

        <div class="item d-flex align-items-center font-xs removeFinalizado">

            <div class="ms-2 me-1 la_cor_texto_1">
                Sorteio
            </div>

            <div class="tag btn btn-sm bg-white bg-opacity-50 font-xss box-shadow-08 la_cor_texto_1">
                {{$rifa->periodo->format('d/m/Y')}} às {{$rifa->periodo->format('H:i:s')}}
            </div>
        </div>
    </div>
    @endif

    @if($rifa->status === 'EM_ANDAMENTO')
    <div class="sorteio-buscas removeFinalizado">

        <div class="row row-gutter-sm">

            <div class="col removeFinalizado">
                <div class="btn btn-sm btn-success box-shadow-08 w-100 mb-2" data-bs-toggle="modal"
                     data-bs-target="#modal-consultaCompras"><i class="bi bi-cart"></i> Ver meus números
                </div>
            </div>


        </div>


        <div class="app-title mb-2"><h1>⚡ Cotas</h1>

            <div class="app-title-desc">Escolha sua sorte
            </div>
        </div>

        @if($rifa->is_compra_automatica)
        <public-sorteio-aleatorio :rifa="{{$rifa}}" :mp_public_key="'{!! $mp_public_key !!}'"></public-sorteio-aleatorio>
        @else
        <public-sorteio-cotas :rifa="{{$rifa}}" :mp_public_key="'{!! $mp_public_key !!}'"></public-sorteio-cotas>
        @endif


    </div>
    @elseif($rifa->status === 'FINALIZADO' && $ganhador)
        <div class="app-ganhadores mb-2 ">
            <div class="col-12">
                <div class="app-title"><h1>🎉 Ganhador</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
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
                </div>
            </div>
        </div>
    @endif



    <div style="width: 100%; height: 80px;" class="espacoFooter"></div>



    <public-modal-meus-numeros></public-modal-meus-numeros>

    <div id="blocoNumeros" style="display: none !important"></div>

@endsection

@section('vendor-script')
@endsection
@section('page-script')

@endsection
