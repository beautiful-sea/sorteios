@extends('layouts.app')



@section('vendor-style')
    {{-- vendor css files --}}

    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <style>
    .SorteioTpl_info__t1BZr{
              
        height:147px !important;
        margin-top: 25px;
        overflow-y:scroll !important;
        
    }
    .SorteioTpl_info__t1BZr::-webkit-scrollbar{
            width: 7px;
    }
    .SorteioTpl_info__t1BZr::-webkit-scrollbar-track{
        border-radius:100vw;
        margin-block: .5em
    }
    
    .SorteioTpl_info__t1BZr::-webkit-scrollbar-thumb{
        background-color:black;
        border-radius:100vw;
    }
    .SorteioTpl_imagemContainer__2-pl4{
        width:120px !important;
        height:120px !important;
        border-radius: 10px;
        margin-left: 13px !important;
        
    } 
    .SorteioTpl_sorteioTpl__2s2Wu{
            
            height:147px;
            
            
    }
  
  
  
  </style>
    @endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/extensions/ext-component-tour.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/pages/app-ecommerce-details.css')}}">

@endsection
@section('content')

    <div id="app">
        <public-meus-numeros></public-meus-numeros>
    </div>

@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }} "></script>
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
@endsection
@section('page-script')
@endsection
