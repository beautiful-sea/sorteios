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
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">
                       <div class="mt-4 mb-2 text-center">
                           <h4>Sorteios disponíveis</h4>
                           <p class="card-text">Compre suas fichas e concorra a prêmios!</p>
                       </div>
                       <div class="swiper-responsive-breakpoints swiper-container px-4 py-2 swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                           <div class="swiper-wrapper"  aria-live="polite"  >
                               <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 2" >
                                   <a href="#">
                                       <div class="item-heading">
                                           <h5 class="text-truncate mb-0">Apple Watch Series 6</h5>
                                           <small class="text-body">Sorteio 20/11/2022 às 20:00</small>
                                       </div>
                                       <div class="img-container w-50 mx-auto py-75">
                                           <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image">
                                       </div>

                                   </a>
                               </div>
                               <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 2" >
                                   <a href="#">
                                       <div class="item-heading">
                                           <h5 class="text-truncate mb-0">Apple MacBook Pro - Silver</h5>
                                           <small class="text-body">Sorteio 20/11/2022 às 20:00</small>
                                       </div>
                                       <div class="img-container w-50 mx-auto py-50">
                                           <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image">
                                       </div>
                                   </a>
                               </div>
                           </div>
                           <!-- Add Arrows -->
                           <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-2b96bb0dcc40b161" aria-disabled="false"></div>
                           <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-2b96bb0dcc40b161" aria-disabled="true"></div>
                           <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
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
    <script src="{{ asset('/vendors/js/extensions/swiper.min.js') }}"></script>

@endsection
