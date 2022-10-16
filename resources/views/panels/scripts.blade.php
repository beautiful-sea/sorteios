<!-- BEGIN: Vendor JS-->

<script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
@yield('vendor-script')


<!-- END: Page Vendor JS-->

{{--Vue--}}
<script src="{{asset('js/app.js')}}"></script>

<script src="{{ asset('vendors/js/popper/popper.min.js') }}"></script>

<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')

