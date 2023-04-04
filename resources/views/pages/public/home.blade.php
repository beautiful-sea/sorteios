@extends('layouts.app')



@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/extensions/ext-component-tour.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/pages/app-ecommerce-details.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendors/css/extensions/swiper.min.css')}} ">
    <style>

        .LiderPulse {
            white-space: nowrap;
            display: block;
            box-shadow: 0 0 0 0 rgba(0, 125, 255, 0.7);
            border-radius: 10px;
            -webkit-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -moz-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -ms-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            transition: all 300ms ease-in-out;
        }


        /* Comment-out to have the button continue to pulse on mouseover */

        a.LiderPulse:hover {
            -webkit-animation: none;
            -moz-animation: none;
            -ms-animation: none;
            animation: none;
        }


        /* Animation */

        @-webkit-keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(0, 125, 255, 0);
            }
        }

        @-moz-keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(0, 125, 255, 0);
            }
        }

        @-ms-keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(0, 125, 255, 0);
            }
        }

        @keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(0, 125, 255, 0);
            }
        }


        .owl-theme .owl-dots {
            display: none;
        }

        #compraragora {
            padding: 110px 0;
            background: #fff;
        }

        #compraragora .wq-cto {
            text-align: center;
        }

        #compraragora .row {
            justify-content: center;
        }


        .planos-item {
            background-color: #009c05;
            border-radius: 10px;
            padding: 20px 20px;
            margin: 0 0 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: center;
            position: relative;
            transition: all .2s linear;
        }

        @media (max-width: 576px) {
            .planos-item {
                background-color: #009c05;
                border-radius: 10px;
                padding: 20px 20px;
                margin: 0 0 15px;
                display: block;
                align-items: center;
                justify-content: space-between;
                text-align: center;
                position: relative;
                transition: all .2s linear;
            }

            .planos-item_titulo {
                max-width: 100%;
            }
        }


        .planos-item:hover {
            transform: scale(1.03);
        }

        .planos-item.melhor-compra {
            box-shadow: 0 8px 60px -6px rgb(255 255 255 / 70%);
            background-color: #ffad09;
            animation: pulsarPlano .75s infinite .75s alternate;
        }

        @keyframes pulsarPlano {
            from {
                transform: scale(1);
                box-shadow: 0px 0px 0px #005000;
            }
            to {
                transform: scale(1.025);
                box-shadow: 0px 0px 25px -5px #005000;
            }
        }

        .planos-item_titulo h3 {
            color: #fff;
            text-transform: uppercase;
            font-weight: 800;
            font-size: 20px;
            line-height: 1.25;
        }

        .planos-item_titulo span {
            color: #fff;
        }

        .planos-item figure {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .planos-item figure img {
            display: block;
            height: 80px;
            width: auto;
        }

        .planos-item figure figcaption {
            background-color: #fff;
            color: #333;
            width: 90px;
            height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: "Work Sans", sans-serif;
            align-items: center;
            border-radius: 100%;
            position: absolute;
            right: 0px;
            top: 0px;
            z-index: 98;
            animation: float-price 1s ease-in-out infinite;
            display: none;
        }

        .planos-item figure figcaption h4 {
            font-size: 15px;
            font-weight: 700;
        }

        .planos-item figure figcaption p {
            font-size: 15px;
            margin-bottom: 0;
        }

        @keyframes float-price {
            0% {
                transform: scale(1) translateZ(50px) rotate(10deg) translate(10px, 10px);
            }
            50% {
                transform: scale(1.15) translateZ(50px) rotate(10deg) translate(10px, 10px);;
            }
            100% {
                transform: scale(1) translateZ(50px) rotate(10deg) translate(10px, 10px);
            }
        }

        .planos-item > span {
            background-color: rgba(250, 250, 250, .5);
            padding: 8px 15px;
            border-radius: 10px;
            font-size: 14px;
            color: #000;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .planos-item .destaque {
            background: #0000007d;
            color: #fff;
            position: absolute;
            top: 0px;
            right: 0px;
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 0px 9px;
            font-size: 11px;
        }

        .planos-item .preco-prazo h4 {
            color: #fff;
            font-size: 75px;
            font-weight: bold;
            letter-spacing: -7px;
            margin: 0px;
            font-family: "Work Sans", sans-serif;
        }

        .planos-item .preco-prazo h4 span {
            font-weight: 100;
            font-size: 30px;
            letter-spacing: 3px;
        }

        .planos-item .entrega {
            margin: 10px 0 0;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.2;
        }

        .planos-item.melhor-compra .btn {
            background-color: #fff;
            color: #005000 !important;
        }

        .planos-item.melhor-compra .btn:hover {
            background-color: #fff5d3;
            color: #222;
        }

        .desconto-02 p {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .desconto {
            margin-top: 10px;
            background-color: #ffd640;
            border-radius: 5px;
            width: max-content;
            padding: 1px 20px;
            display: inline-flex;
            align-items: center;
        }

        .desconto p {
            margin-bottom: 0;
            color: #000;
            font-size: 15px;
            font-weight: 600;
        }

        .planos-item .preco-avista h3 {
            color: #fff;
            text-transform: uppercase;
            font-weight: 800;
            font-size: 27px;
            line-height: 1.25;
        }

        .planos-item .btn {
            font-size: 14px;
            padding: 12px 25px;
        }

        .btn.btn_02 {
            background-color: #ffdf00;
            color: #188318;
        }

        .btn-planos {
            display: inline-flex;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            /* color: #005000; */
            color: #FFF;
            padding: 12px 34px;
            border-radius: 30px;
            text-align: center;
            /* background-color: #ffdf00; */
            background-color: #fd5631;
            transition: all .2s linear;
        }

        .earnings-card {
            box-shadow: 1px 1px 2px 0px black;
            color: black;
            margin: 0px;
        }

        .row {
            margin: 0px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="app-title"><h1>⚡ Prêmios</h1>
                <div class="app-title-desc">Escolha sua sorte
                </div>
            </div>
        </div>
        @foreach($rifas as $key=>$rifa)
            @if($key === 0)
                <div class="col-12 mb-2" onclick="window.location.href = '/sorteios/{{$rifa->id}}'">
                    <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR  pointer">
                        <div class="SorteioTpl_imagemContainer__2-pl4 col-auto blocoImagemSlide">
                            <div id="carouselSorteio63bc967f0ad56" class="carousel slide carousel-dark carousel-fade"
                                 data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active imagemSlide blocoImagemSlide"
                                         style="width:100%;height:290px">
                                        <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                            <img alt="CHEVROLET CORVETTE STI 2020"
                                                 src="{{\Storage::url($rifa->primeira_imagem->path)}}"
                                                 decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI"
                                                 style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                            <noscript><img alt="{{$rifa->titulo}}"
                                                           src="{{\Storage::url($rifa->primeira_imagem->path)}}"
                                                           decoding="async" data-nimg="fill"
                                                           style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                                                           class="SorteioTpl_imagem__2GXxI" loading="lazy"/></noscript>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="SorteioTpl_info__t1BZr"><h1 class="SorteioTpl_title__3RLtu">{{$rifa->titulo}}</h1>
                            <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">
                                {{$rifa->resumo}}
                            </p>
                            @if($rifa->status === 0)
                                <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
                            @elseif($rifa->status === 1)
                                <span class="badge bg-black font-xsss">Concluído! </span>
                            @else
                                <span class="badge bg-warning font-xsss">Em breve! </span>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 mb-2" onclick="window.location.href = '/sorteios/{{$rifa->id}}'">
                    <div class="SorteioTpl_sorteioTpl__2s2Wu   pointer">
                        <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">
                            <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                <img alt="250 PRA 20.000,00"
                                     src="{{\Storage::url($rifa->primeira_imagem->path)}}"
                                     decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI"
                                     style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                <noscript><img alt="{{$rifa->titulo}}"
                                               src="{{\Storage::url($rifa->primeira_imagem->path)}}"
                                               decoding="async" data-nimg="fill"
                                               style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                                               class="SorteioTpl_imagem__2GXxI" loading="lazy"/>
                                </noscript>
                            </div>
                        </div>
                        <div class="SorteioTpl_info__t1BZr">
                            <h1 class="SorteioTpl_title__3RLtu">{{$rifa->titulo}}
                                <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">🍀Concorra a uma Hillux
                                    {{$rifa->resumo}}
                                </p>
                                @if($rifa->status === 0)
                                    <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
                                @elseif($rifa->status === 1)
                                    <span class="badge bg-black font-xsss">Concluído! </span>
                                @else
                                    <span class="badge bg-warning font-xsss">Em breve! </span>
                                @endif
                            </h1>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="app-ganhadores mb-2 p-0 ">
            <div class="col-12">
                <div class="app-title"><h1>🎉 Ganhadores</h1>
                    <div class="app-title-desc">sortudos
                    </div>
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
                            <div class="undefined w-100"><h3 class="ganhadorItem_ganhadorNome__2j_J-">Patrícia
                                    Mendes</h3>
                                <p class="ganhadorItem_ganhadorDescricao__Z4kO2">Ganhou <b>HILUX SRX OU R$ 280</b>
                                    número 0832</p>
                            </div>
                            <div>
                                <div class="rounded-pill"
                                     style="width:40px;height:40px;position:relative;overflow:hidden">
                                    <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                        <img alt="RIFA DE GRUPO 500 PRA 10.000,00"
                                             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
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

        <div class="app-perguntas">
            <div class="app-title"><h1>🤷 Perguntas frequentes</h1>
            </div>
            <div id="perguntas-box">
                <div class="mb-2" style="cursor: pointer;">
                    <div class="pergunta-item d-flex flex-column p-2 bg-card box-shadow-08 rounded-10 font-weight-500 font-xs">
                        <div class="pergunta-item--pergunta" data-bs-toggle="collapse" data-bs-target="#pergunta-3"
                             aria-expanded="false" aria-controls="pergunta-3"><i
                                    class="bi bi-arrow-right me-2 text-cor-primaria"></i>
                            <span>COMO VEJO MEUS NÚMEROS?												</span>
                        </div>
                        <div class="d-block">
                            <div class="pergunta-item--resp collapse mt-1 text-muted" id="pergunta-3"
                                 data-bs-parent="#perguntas-box">
                                <p>Acesse o menu Meus Números ou o carrinho de compras no topo do site, informe seu
                                    telefone e você poderá ver todas as suas compras realizadas.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2" style="cursor: pointer;">
                    <div class="pergunta-item d-flex flex-column p-2 bg-card box-shadow-08 rounded-10 font-weight-500 font-xs">
                        <div class="pergunta-item--pergunta" data-bs-toggle="collapse" data-bs-target="#pergunta-1"
                             aria-expanded="false" aria-controls="pergunta-1"><i
                                    class="bi bi-arrow-right me-2 text-cor-primaria"></i>
                            <span>PRECISO ENVIAR COMPROVANTE?												</span>
                        </div>
                        <div class="d-block">
                            <div class="pergunta-item--resp collapse mt-1 text-muted" id="pergunta-1"
                                 data-bs-parent="#perguntas-box">
                                <p>Caso você tenha feito o pagamento via Pix QR Code ou copiando o código, não é
                                    necessário enviar o comprovante, aguardando até 5 minutos após o pagamento, o
                                    sistema irá dar baixa automaticamente.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2" style="cursor: pointer;">
                    <div class="pergunta-item d-flex flex-column p-2 bg-card box-shadow-08 rounded-10 font-weight-500 font-xs">
                        <div class="pergunta-item--pergunta" data-bs-toggle="collapse" data-bs-target="#pergunta-2"
                             aria-expanded="false" aria-controls="pergunta-2"><i
                                    class="bi bi-arrow-right me-2 text-cor-primaria"></i>
                            <span>POSSO COMPRAR MAIS NÚMEROS?												</span>
                        </div>
                        <div class="d-block">
                            <div class="pergunta-item--resp collapse mt-1 text-muted" id="pergunta-2"
                                 data-bs-parent="#perguntas-box">
                                <p>Claro. Você pode comprar quantos números e quantas vezes quiser. Quantos mais você
                                    comprar mais chances tem de ganhar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }} "></script>
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset('/vendors/js/extensions/swiper.min.js') }}"></script>

@endsection
