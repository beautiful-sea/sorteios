<!DOCTYPE html>
@isset($pageConfigs)
{!! \Helper::updatePageConfig($pageConfigs) !!}
@endisset

        <!DOCTYPE html>

<html class="loading light"
      lang=" pt"
      data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
    <meta name="description" content="Participar é fácil: basta escolher a rifa que mais lhe interessa, adquirir um ou vários números e aguardar o sorteio. Nossas rifas oferecem prêmios exclusivos!">
    <meta property="og:image" content="data:image/png;base64,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">
    <script src="https://www.google.com/recaptcha/api.js?render={{config('recaptcha.v3.public_key')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
   <style>
        .content-new {
            margin-left: 0px;
        }

        @if(!auth()->check())
            html .content-new {
            padding: 0;
            position: relative;
            transition: 300ms ease all;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            min-height: calc(100% - 3.35rem);
        }

        .header-navbar.floating-nav {
            position: fixed;
            left: 0;
            margin: 1.3rem 8rem;
            width: 85%;
            border-radius: 0.428rem;
            z-index: 12;
        }
        @endif
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
            integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Include core + vendor Styles --}}

    @include('panels.styles')


</head>
<body class="pace-done vertical-layout vertical-menu-modern navbar-floating footer-static default menu-expanded"
      data-menu="vertical-menu-modern"
      data-col="blank-page"
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}">
@include('panels.navbar')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
{{--@if(auth()->check())--}}
{{--    @include('panels.sidebar')--}}
{{--@endif--}}
<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<div class="container app-main layoutFundoGeralConteudo">
    <div id="app">
        @yield('content')
    </div>
</div>

@include('panels.footer')

@include('panels.scripts')
</body>
</html>
