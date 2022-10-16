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
        @media (max-width: 576px)
        {
            .planos-item{
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
    </style>
@endsection
@section('content')

    <section>
        <div class="row ">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-12 col-md-7  mb-2 mb-md-0">
                                <h4>GOLF GTI MK7 STG</h4>

                                <div class="d-flex  " style="    height: fit-content;">
                                    <img src="https://dmais.shop/wp-content/uploads/2022/02/golf5a.png"
                                         class="img-fluid product-img" alt="product image">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                    <h4 class="item-price me-1"><span
                                            class="card-text item-company">Valor do número:</span> <b>R$ 2,00 </b></h4>
                                </div>
                                <p class="card-text"><span class="text-success">Números disponíveis</span></p>
                                <p><strong>RECURSOS DO NOSSO SISTEMA:</strong><br>• Sorteios ilimitados;<br>• Sorteios
                                    com até 100 mil números;<br>• Recebimento por mercadopago (PIX ou Cartão);<br>•
                                    Baixas automáticas;<br>• Descontos progressivos;<br>• Painel de Afiliados;<br>• Top
                                    Five (clientes que mais compraram)<br>• Compra mínima de números;<br>• Galeria de
                                    fotos e vídeo;<br>• Cronômetro regressivo;<br>• Escolha de números automático pelo
                                    sistema;<br>• Exibir/Ocultar números para escolha (opcional);<br>• Botão de cobrança
                                    direto para Whatsapp;<br>• Filtros de busca dos pedidos;</p>
                                <div class="product-color-options product-features">
                                    <h6>Colors</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block">
                                            <div class="color-option b-primary">
                                                <img src="https://dmais.shop/wp-content/uploads/2022/02/golf5a.png"
                                                     class="img-fluid product-img" style="width: 50px!important" alt="product image">
                                            </div>
                                        </li>
                                        <li class="d-inline-block">
                                            <div class="color-option b-success">
                                                <img src="https://dmais.shop/wp-content/uploads/2022/02/golf5a.png"
                                                     class="img-fluid product-img"  style="width: 50px!important"  alt="product image">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="  col-12">
                <div style="background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%);" class="card text-white text-center cardlucky mb-3 mt-3 animate__animated animate__bounceIn animate__delay-1s ">

                    <div class="card-body">

                        <h5 class="card-title color-white"><b>Números da Sorte!</b></h5>

                        <p class="card-text">Escolha a quantidade que quiser comprar! Quanto mais números comprar, mais chances de ganhar!</p>

                    </div>

                    <div class="card-footer bg-transparent border-transparent">

                        <a class="btn btn-lg d-block mt-2 text-dark LiderPulse" onclick="LuckyScreen()" style="background-color:#ffc900; box-shadow: 0 0 0 0 #ffc900; border-radius: 10px;"><b>COMPRAR NÚMEROS <i class="fa fa-thumbs-up" aria-hidden="true"></i></b></a>

                    </div>

                </div>
            </div>
        </div>
        <div class="row wq-planos">
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item ">
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>2 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 4,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 2,00</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('2')">
                            Comprar Agora
                        </button>

                        <p class="entrega">2 Chances
                            de ganhar*</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item ">
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>22 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 44,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 30,80</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('22')">
                            Comprar Agora
                        </button>

                        <p class="entrega">22 Chances
                            de ganhar*</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item melhor-compra">
                    <div class="destaque">CAMPEÃO DE VENDAS</div>
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>32 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 64,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 41,60</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('32')">
                            Comprar Agora
                        </button>

                        <p class="entrega">32 Chances
                            de ganhar*</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item ">
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>42 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 84,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 50,40</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('42')">
                            Comprar Agora
                        </button>

                        <p class="entrega">42 Chances
                            de ganhar*</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item ">
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>52 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 104,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 57,20</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('52')">
                            Comprar Agora
                        </button>

                        <p class="entrega">52 Chances
                            de ganhar*</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12 ">
                <div class="planos-item ">
                    <figure>
                        <img src="controllerJava/img/logo-rede-premios.png" alt="" title="">
                        <figcaption>
                            <h4>R$ 12</h4>
                            <p>10 cartelas</p>
                        </figcaption>
                    </figure>

                    <div class="planos-item_titulo">
                        <h3>62 - número(s) </h3>
                        <span></span>
                    </div>

                    <div>
                        <div class="desconto-02">
                            <p><s>DE
                                    R$ 124,00</s>
                            </p>
                        </div>
                        <div class="preco-avista">
                            <h3>POR
                                R$ 62,00</h3>
                        </div>
                    </div>

                    <div>
                        <input type="text" name="kit" value="10" style="display: none;">
                        <input type="text" name="pixelvenda" value="" style="display: none;">

                        <button type="submit" class="btn btn-planos btn_02" onclick="ComprarDesconto('62')">
                            Comprar Agora
                        </button>

                        <p class="entrega">62 Chances
                            de ganhar*</p>
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
@endsection
@section('page-script')
@endsection
