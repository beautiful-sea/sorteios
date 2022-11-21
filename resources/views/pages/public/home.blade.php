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

        .row{
            margin: 0px;
        }
    </style>
@endsection
@section('content')

        <div class="row">
            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"
                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_184016b47a2%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_184016b47a2%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.3125%22%20y%3D%22217.7%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_184016b47a2%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_184016b47a2%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.3125%22%20y%3D%22217.7%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_184016b47a2%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_184016b47a2%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.3125%22%20y%3D%22217.7%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                 alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-12" style="padding: 10px 20px">
                <div class="card earnings-card">
                    <div class="card-body" style="padding: 20px">
                        <div class="row">
                            <div class="col-4" style="margin: auto;text-align: center;">
                                <img  style="width: 100%" src="/images/73181-select.gif">
                            </div>
                            <div class="col-8"  style="margin: auto;">
                                <h3 style="color: white">Escolha uma rifa</h3>
                                <p>É muito fácil participar. Comece escolhendo uma rifa ativa
                                    disponível</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-12" style="padding: 10px 20px">
                <div class="card earnings-card">
                    <div class="card-body" style="padding: 20px">
                        <div class="row">
                            <div class="col-4" style="margin: auto;text-align: center;">
                                <img style="width: 100%" src="/images/19527-select-option.gif">
                            </div>
                            <div class="col-8">
                                <h3 style="color: white">Selecione os números</h3>
                                <p>Escolha quantos quiser! Quanto mais escolher, mais chances de
                                    ganhar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-12" style="padding: 10px 20px">
                <div class="card earnings-card">
                    <div class="card-body" style="padding: 20px">
                        <div class="row">
                            <div class="col-4" style="margin: auto;text-align: center;">
                                <img style="width: 100%" src="/images/37960-online-payment.gif">
                            </div>
                            <div class="col-8">
                                <h3 style="color: white">Faça o pagamento</h3>
                                <p>Escolha uma das nossas formas de pagamento disponíveis no site.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-12" style="padding: 10px 20px">
                <div class="card earnings-card">
                    <div class="card-body" style="padding: 20px">
                        <div class="row">
                            <div class="col-4" style="margin: auto;text-align: center;">
                                <img style="width: 100%" src="/images/67230-trophy-winner.gif">
                            </div>
                            <div class="col-8">
                                <h3 style="color: white">Aguarde o sorteio</h3>
                                <p>Agora é aguardar o sorteio pela Loteria Federal e boa sorte para
                                    você!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt-4 mb-2 text-center">
                <h2>Sorteios disponíveis</h2>
                <p class="card-text" style="font-size: 18px">Compre suas fichas e concorra a prêmios!</p>
            </div>
        </div>
        <div class="row">
            @foreach($rifas as $rifa)
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top"
                             src="{{\Storage::url($rifa->primeira_imagem->path)}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{$rifa->titulo}}</h4>
                            <p class="card-text">
                                {{$rifa->resumo}}
                            </p>
                            @if($rifa->status === 0)
                                <a href="/sorteios/{{$rifa->id}}" class="btn btn-success waves-effect">Ver sorteio</a>
                            @elseif($rifa->status === 1)
                                <a href="#" class="btn btn-danger waves-effect">Ver resultado</a>
                            @else
                                <button disabled href="#" class="btn btn-info waves-effect">Em breve</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach


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
