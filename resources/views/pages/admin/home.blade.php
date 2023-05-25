@extends('pages.admin.layouts.app')

@section('head')
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <admin-dashboard-estatisticas></admin-dashboard-estatisticas>

    <!-- Content Row -->

    <div class="row">
        <admin-dashboard-pedidos></admin-dashboard-pedidos>
        <!-- Area Chart -->
        <admin-dashboard-grafico-ganhos-mensais></admin-dashboard-grafico-ganhos-mensais>

        <!-- Pie Chart -->
        <admin-dashboard-porcentagem-vendas-por-rifa></admin-dashboard-porcentagem-vendas-por-rifa>
    </div>



@endsection

@section ('page-script')
{{--    <script src="/admin/vendor/chart.js/Chart.min.js"></script>--}}
{{--    <script src="/admin/js/demo/chart-area-demo.js"></script>--}}
{{--    <script src="/admin/js/demo/chart-pie-demo.js"></script>--}}
@endsection
