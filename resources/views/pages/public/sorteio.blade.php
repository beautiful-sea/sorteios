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

        h2 {
            font-family: montserrat;
            font-size: 32px;
            line-height: 38.4px;
            vertical-align: baseline;
            letter-spacing: normal;
            word-spacing: 0px;
            margin: 0px;
            padding: 0px;
            font-weight: 700;
            text-transform: uppercase;
            color: black;
        }

        .badge-sorteio p {
            font-family: montserrat;
            font-size: 19px;
            font-style: normal;
            font-variant-caps: normal;
            font-variant-east-asian: normal;
            font-variant-ligatures: normal;
            font-variant-numeric: normal;
            font-weight: 400;

        }

        .badge-sorteio .info-badge-sorteio {
            font-family: montserrat;
            font-size: 22px;
            font-style: normal;
            font-variant-caps: normal;
            font-variant-east-asian: normal;
            font-variant-ligatures: normal;
            font-variant-numeric: normal;
            font-weight: 700;

        }

        .raffle-ticket-container {
            display: flex !important;
            flex-wrap: wrap !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        .raffle-ticket--available .raffle-ticket-number.raffle-ticket-number--available, .raffle-ticket--paid .raffle-ticket-number.raffle-ticket-number--paid, .raffle-ticket--reserved .raffle-ticket-number.raffle-ticket-number--reserved, .raffle-ticket--all .raffle-ticket-number {
            display: block !important;
        }

        .raffle-ticket-number--reserved {
            color: #fff !important;
            background-color: #17a2b8 !important;
        }

        .raffle-ticket-number--available {
            color: #212529 !important;
            background-color: #ccc !important;
        }

        .raffle-ticket-number--paid {
            color: #fff !important;
            background-color: #28a745 !important;
        }

        @media (min-width: 992px) {
            .raffle-ticket-number {
                max-width: 56px !important;
            }
        }

        @media (min-width: 576px) {
            .raffle-ticket-number {
                max-width: 56px !important;
            }
        }

        .raffle-ticket-number {
            display: none;
            position: relative;
            cursor: pointer;
            padding: 0.75rem;
            font-size: .9em;
            min-width: 53px;
            flex: 1 1 0px !important;
            flex-grow: 1;
            flex-shrink: 1;
            flex-basis: 0;
        }

        .raffle-ticket-number .numero-tooltip {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translate(-50%, 0);
            background-color: black;
            font-size: 12px;
            padding: 5px 8px;
            font-weight: normal;
            border-radius: 3px;
            line-height: 15px;
            margin-bottom: 5px;
            color: white;
            pointer-events: none;
            z-index: 999;
        }

        .raffle-ticket-number--available:hover {
            background-color: #b3b3b3 !important;
        }

        .raffle-ticket-number--selected {
            cursor: pointer !important;
            color: #fff !important;
            background-color: #17a2b8 !important;
        }

        @media (min-width: 992px) {
            .raffle-ticket-number {
                max-width: 56px !important;
            }
        }

        @media (min-width: 576px) {
            .raffle-ticket-number {
                max-width: 56px !important;
            }
        }
    </style>
@endsection
@section('content')

    <section>
        <div class="row ">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h2>{{$rifa->titulo}}</h2>
                                <p style="font-size: 20px">{{$rifa->resumo}}</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">

                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($rifa->imagens as $key=>$imagem)
                                            <div class="carousel-item {{$key ===0?'active':''}}">
                                                <img class="d-block w-100"
                                                     src="{{\Storage::url($imagem->path)}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Voltar</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Próximo</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12  col-md-6 col-lg-6">
                                <div class="d-flex justify-content-between">
                                    <div class="badge-sorteio"
                                         style="padding: 10px;border-radius: 5px; background-color: #008800;width: 100%;text-align: center;height: 70px;margin: 10px">
                                        <h4 class="info-badge-sorteio" style="color: white">Valor</h4>
                                        <p style="color: white;font-size: 16px">{{$rifa->valor_por_numero_em_real}}</p>
                                    </div>
                                    <div class="badge-sorteio"
                                         style="padding: 10px;border-radius: 5px; background-color: dimgrey;width: 100%;text-align: center;height: 70px;margin: 10px">
                                        <h4 class="info-badge-sorteio" style="color: white">Data</h4>
                                        <p style="color: white;font-size: 16px">{{$rifa->periodo_formatado}}</p>
                                    </div>
                                </div>
                                <div class="d-flex m-1">
                                    {!! $rifa->descricao !!}
                                </div>
                                <div class="m-1 mt-4">
                                    <div>
                                        <h4 style="font-weight: 900; "><span
                                                style="border-left: 6px solid green; margin-right: 10px;"></span>COMPRA
                                            AUTOMÁTICA</h4>
                                        <p>O site escolhe números aleatórios para você.</p>
                                    </div>
                                    <div class="d-flex justify-content-between"
                                         style="background-color: #008800; padding: 10px; border-radius: 10px">
                                        <div class="d-flex justify-content-between">
                                            <span style="border: 3px solid darkgreen;margin: auto;border-radius: 5px">
                                                <i style="color: darkgreen" class="fa-solid fa-minus fa-fw"></i>
                                            </span>
                                            <input value="1" type="number"
                                                   style="background-color: darkgreen;color: white;width: 100px;margin: 5px; border-radius: 10px;border: none; text-align:center">
                                            <span style="border: 3px solid darkgreen;margin: auto;border-radius: 5px">
                                                <i style="color: darkgreen" class="fa-solid fa-plus fa-fw"></i>
                                            </span>
                                        </div>
                                        <button class="btn "
                                                style="border-radius: 15px;color: white;background-color: darkgreen">
                                            Comprar
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3" style="padding: 0px">
                                <div class="card earnings-card">
                                    <div class="card-body" style="padding: 20px">
                                        <div class="row">
                                            <div class="col-4" style="margin: auto;text-align: center;">
                                                <img style="width: 100%" src="/images/73181-select.gif">
                                            </div>
                                            <div class="col-8 m-auto">
                                                <h4>Escolha uma rifa</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-12" style="padding: 0px">
                                <div class="card earnings-card">
                                    <div class="card-body" style="padding: 20px">
                                        <div class="row">
                                            <div class="col-4" style="margin: auto;text-align: center;">
                                                <img style="width: 100%" src="/images/19527-select-option.gif">
                                            </div>
                                            <div class="col-8 m-auto">
                                                <h4>Selecione os números</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-12" style="padding: 0px">
                                <div class="card earnings-card">
                                    <div class="card-body" style="padding: 20px">
                                        <div class="row">
                                            <div class="col-4" style="margin: auto;text-align: center;">
                                                <img style="width: 100%" src="/images/37960-online-payment.gif">
                                            </div>
                                            <div class="col-8 m-auto">
                                                <h4>Faça o pagamento</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-12" style="padding: 0px">
                                <div class="card earnings-card">
                                    <div class="card-body" style="padding: 20px">
                                        <div class="row">
                                            <div class="col-4" style="margin: auto;text-align: center;">
                                                <img style="width: 100%" src="/images/67230-trophy-winner.gif">
                                            </div>
                                            <div class="col-8 m-auto">
                                                <h4>Aguarde o sorteio</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <public-sorteio-comprar :rifa="{{$rifa}}" :mp_public_key="{{json_encode($mp_public_key)}}"></public-sorteio-comprar>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }} "></script>
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
@endsection
@section('page-script')
@endsection
