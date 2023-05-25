@extends('pages.admin.layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configurações do Sistema</h1>
    </div>

    <div class="row">
        <admin-configuracao-termos></admin-configuracao-termos>

        <admin-configuracao-metodo-pagamento></admin-configuracao-metodo-pagamento>

        <admin-configuracao-perguntas-frequentes></admin-configuracao-perguntas-frequentes>
    </div>
@endsection

