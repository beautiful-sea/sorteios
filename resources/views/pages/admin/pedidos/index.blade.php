@extends('pages.admin.layouts.app')

@section('title', 'Pedidos')

@section('content')

    <section>
        <admin-dashboard-pedidos :with-extra-options="true"></admin-dashboard-pedidos>
    </section>
@endsection
