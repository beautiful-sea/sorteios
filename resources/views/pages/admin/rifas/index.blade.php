@extends('pages.admin.layouts.app')

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

    <section>
        <div class="row" id="basic-table">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Buscar Pedido</h5>
                        <span>Filtros para busca de pedidos</span>
                    </div>

                    <div class="card-body">
                        <form action="/rifas">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Por Sorteio: </label>
                                        <select class="form-control" name="rifa" id="filtroSorteio">
                                            <option value="">Selecione o sorteio</option>
                                            @foreach(\App\Models\Rifa::all() as $rifa)
                                                <option value="{{$rifa->id}}"  @if(request('rifa') == $rifa->id) selected @endif>{{$rifa->titulo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Status do pedido: </label>
                                        <select class="form-control" name="status" id="filtroStatus">
                                            <option value="">Selecione o status</option>
                                            <option @if(request('status') === "EM_BREVE") selected @endif value="EM_BREVE">Em breve</option>
                                            <option @if(request('status') === "EM_ANDAMENTO") selected @endif value="EM_ANDAMENTO">Em andamento</option>
                                            <option @if(request('status') === "FINALIZADO") selected @endif value="FINALIZADO">Finalizado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>№ Pedido: </label>
                                        <input type="text" name="pedido_id" class="form-control format-phone-number" id="filtroCodPedido" placeholder="Ex 8052" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Digite o Nome, E-mail ou Telefone do Cliente: </label>
                                        <input type="text" class="form-control" name="search" id="filtroDescricao" placeholder="Digite o Nome, E-mail ou Telefone do Cliente" value="{{request('search')}}">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>№ Sorteado: </label>
                                        <input type="text" name="numero_sorteado" class="form-control" placeholder="" id="filtroNumeroSorteado" value="{{request('numero_sorteado')}}">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <button id="btnbuscar" class="btn btn-primary btn-block" style="margin-top: 29px;" type="submit"><i class="fa fa-search"></i> &nbsp; Buscar</button>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <button id="btnlimpar" class="btn btn-light btn-block" style="margin-top: 29px;" type="reset" ><i class="fa fa-ban"></i> &nbsp; Limpar</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="/rifas/create"> Criar Rifa</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="my-1 success p-2 alert alert-success">
                                {{session()->get('message')}}
                            </div>
                        @endif
                            @if ($errors->any())
                                <div class="my-1 alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Ganhador</th>
                                <th>Número Sorteado</th>
                                <th>Data Sorteio</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rifas as $rifa)
                                <tr>
                                    <td>{{$rifa->titulo}}</td>
                                    <td>
                                        {{$rifa->ganhador->nome_cliente ?? '--'}}
                                    </td>
                                    <td>{{$rifa->numero_sorteado_formatado}}</td>
                                    <td>{{$rifa->created_at }}</td>
                                    <td>{{$rifa->valor_em_real}}</td>
                                    <td>
                                        @if($rifa->status == 'EM_ANDAMENTO')
                                            <span class="badge badge-secondary">Em andamento</span>
                                        @elseif($rifa->status == 'FINALIZADO')
                                            <span class="badge badge-success">Finalizado</span>
                                        @elseif($rifa->status == 'EM_BREVE')
                                            <span class="badge badge-warning">Em breve</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn  btn-sm btn-info" href="/rifas/{{$rifa->id}}/edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>
                                            <form class="ms-1" method="post" action="/rifas/{{$rifa->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">
                                    <div class="text-center">
                                        Nenhuma rifa cadastrada.
                                    </div>
                                </td>
                            @endforelse
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
