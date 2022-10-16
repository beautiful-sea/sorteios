<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" href="{{ asset('css/app.css') }}" />


<link rel="stylesheet" href="{{ asset('vendors/css/vendors.min.css') }}" />
@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset('css/core.css') }}" />


<!-- BEGIN: Page CSS-->
<link rel="stylesheet" href="{{ asset('css/base/core/menu/menu-types/horizontal-menu.css') }}" />
<style>
    .avatar{
        object-fit: cover!important;
    }

    .vs__no-options{
        visibility: hidden;
    }
</style>
{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset('css/overrides.css') }}" />


<!-- BEGIN: Custom CSS-->

<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
