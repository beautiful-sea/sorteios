@extends('layouts.app')

@section('title', 'Dashboard')

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

@endsection
@section('content')

    <section >
        <div class="row match-height">

        </div>
        <div class="row">
            <h3>Produtos</h3>
            <div class="col-md-4">

            </div>
            <div class="col-lg-8 col-12">

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
