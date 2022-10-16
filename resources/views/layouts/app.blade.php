<!DOCTYPE html>
@isset($pageConfigs)
{!! \Helper::updatePageConfig($pageConfigs) !!}
@endisset

    <!DOCTYPE html>

<html class="loading light"
      lang=" pt"
      data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') - Bitfuel - Painel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
    <script src="https://www.google.com/recaptcha/api.js?render={{config('recaptcha.v3.public_key')}}"></script>
    {{-- Include core + vendor Styles --}}
    @include('panels.styles')

</head>
    <body  class="pace-done vertical-layout vertical-menu-modern navbar-floating footer-static default menu-expanded"
           data-menu="vertical-menu-modern"
           data-col="blank-page"
           data-framework="laravel"
           data-asset-path="{{ asset('/')}}">
        @include('panels.navbar')
        <!-- END: Header-->

            <!-- BEGIN: Main Menu-->
            @include('panels.sidebar')
        <!-- END: Main Menu-->
            <!-- BEGIN: Content-->
            <div class="app-content content " id="app">
                <div class="content-overlay"></div>
                <div class="header-navbar-shadow"></div>
                <div >
                    <div class="sidebar">
                        {{-- Include Sidebar Content --}}
                        @yield('content-sidebar')
                    </div>
                </div>
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-body">
                        <div class="content-header row">
                            <h1>@yield("title")</h1>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- End: Content-->
            <div class="sidenav-overlay"></div>
            <div class="drag-target"></div>
        @include('panels.footer')

        @include('panels.scripts')
    </body>
</html>
