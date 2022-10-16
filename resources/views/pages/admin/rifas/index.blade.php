@extends('layouts.app')

@section('title', 'Rifas')

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
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="/rifas/create"> Criar Rifa</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="my-1 success alert alert-success">
                                {{session()->get('message')}}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Imagem</th>
                                <th>Prêmio</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                 <td></td>
                            </tr>
                            </tbody>
                        </table>
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
