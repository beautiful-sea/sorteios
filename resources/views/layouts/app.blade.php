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
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') - Sorteios - Painel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
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
    @yield('content')
</div>
<!-- End: Content-->
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
@include('panels.footer')

@include('panels.scripts')
</body>
</html>
