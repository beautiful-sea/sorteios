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
    <link rel="stylesheet" type="text/css" href="/css/base/plugins/forms/form-file-uploader.css">


@endsection
@section('content')

    <section >
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informações da rifa</h4>
                    </div>
                    <div class="card-body">
                        <form action="/rifas" method="post" class="form" enctype="multipart/form-data" id="formRifa">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="titulo">Título</label>
                                        <input value="{{old('titulo')}}" type="text" id="titulo" class="form-control" name="titulo">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="descricao">Descrição</label>
                                        <textarea type="text"  class="form-control"  name="descricao">
                                        {{old('descricao')}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="resumo">Resumo</label>
                                        <input value="{{old('resumo')}}" type="text" id="resumo" class="form-control"   name="resumo">
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h4 class="card-title">Dados da Rifa</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dados-tab-fill" data-bs-toggle="tab" href="#dados-fill" role="tab" aria-controls="dados-fill" aria-selected="true">Dados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="configuracoes-tab-fill" data-bs-toggle="tab" href="#configuracoes-fill" role="tab" aria-controls="configuracoes-fill" aria-selected="false">Configurações</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="top_five-tab-fill" data-bs-toggle="tab" href="#top_five-fill" role="tab" aria-controls="top_five-fill" aria-selected="false">Top Five</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="imagens-tab-fill" data-bs-toggle="tab" href="#imagens-fill" role="tab" aria-controls="imagens-fill" aria-selected="false">Imagens</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="whatsapp-tab-fill" data-bs-toggle="tab" href="#whatsapp-fill" role="tab" aria-controls="whatsapp-fill" aria-selected="false">Whatsapp</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="numero_sorteado-tab-fill" data-bs-toggle="tab" href="#numero_sorteado-fill" role="tab" aria-controls="numero_sorteado-fill" aria-selected="false">Número Sorteado</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content pt-1">
                                        <div class="tab-pane active" id="dados-fill" role="tabpanel" aria-labelledby="dados-tab-fill">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="premio">Prêmio *</label>
                                                        <input value="{{old('premio')}}" type="text" id="premio" class="form-control" name="premio" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="status">Status da rifa</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('status')}}" type="checkbox" class="form-check-input" id="status">
                                                            <label class="form-check-label" for="status">Encerrado</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="mostrar_data_sorteio">Informar data do sorteio</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('mostrar_data_sorteio')}}" type="checkbox" class="form-check-input" id="mostrar_data_sorteio">
                                                            <label class="form-check-label" for="mostrar_data_sorteio">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="periodo">Período de exclusão *</label>
                                                        <input value="{{old('periodo')}}"   type="datetime-local" id="periodo" class="form-control" name="periodo" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="valor_por_numero">Valor por número (R$) *</label>
                                                        <input value="{{old('valor_por_numero')}}" type="text" id="valor_por_numero" class="form-control" name="valor_por_numero" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="quantidade_de_numeros">Quantidade de Números *</label>
                                                        <input value="{{old('quantidade_de_numeros')}}" type="number" id="quantidade_de_numeros" class="form-control" name="quantidade_de_numeros" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="quantidade_maxima_de_numeros">Quantidade máxima de Números *</label>
                                                        <input value="{{old('quantidade_maxima_de_numeros')}}" type="number" id="quantidade_maxima_de_numeros" class="form-control" name="quantidade_maxima_de_numeros" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="porcentagem_comissao_vendas">Porcentagem de comissão por vendas (%)</label>
                                                        <input value="{{old('porcentagem_comissao_vendas')}}" type="number" id="porcentagem_comissao_vendas" class="form-control" name="porcentagem_comissao_vendas" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="has_compra_minima">Compra mínima</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('has_compra_minima')}}" type="checkbox" class="form-check-input" id="has_compra_minima">
                                                            <label class="form-check-label" for="has_compra_minima">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="contato_whatsapp">Contato do whatsapp *</label>
                                                        <input value="{{old('contato_whatsapp')}}" type="text" id="contato_whatsapp" class="form-control" name="contato_whatsapp" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="configuracoes-fill" role="tabpanel" aria-labelledby="configuracoes-tab-fill">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="is_compra_automatica">Habilitar compra automática?</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('is_compra_automatica')}}" type="checkbox" class="form-check-input" id="is_compra_automatica">
                                                            <label class="form-check-label" for="is_compra_automatica">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="top_five-fill" role="tabpanel" aria-labelledby="top_five-tab-fill">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="has_top_five">Top Five</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('has_top_five')}}" type="checkbox" class="form-check-input" id="has_top_five">
                                                            <label class="form-check-label" for="has_top_five">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="premio_top_five">O que o primeiro lugar vai ganhar? *</label>
                                                        <input value="{{old('premio_top_five')}}" type="text" name="premio_top_five" class="form-control" id="premio_top_five" placeholder="Um Pix de R$ 1.500,00">
                                                    </div>
                                                </div>
                                                <div class=" col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="definir_ganhador_top_five">Definir Ganhador?</label>
                                                        <div class="form-check form-switch">
                                                            <input value="{{old('definir_ganhador_top_five')}}" type="checkbox" class="form-check-input" id="definir_ganhador_top_five">
                                                            <label class="form-check-label" for="definir_ganhador_top_five">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>Dados do ganhador</h3>
                                                <div class=" col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="nome_ganhador_top_five">Nome do ganhador *</label>
                                                        <input value="{{old('nome_ganhador_top_five')}}" type="text" name="nome_ganhador_top_five" class="form-control" id="nome_ganhador_top_five" >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="telefone_ganhador_top_five">Telefone do ganhador *</label>
                                                        <input value="{{old('telefone_ganhador_top_five')}}" type="text" name="telefone_ganhador_top_five" class="form-control" id="telefone_ganhador_top_five" >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="total_cotas_ganhador_top_five">Total de cotas compradas *</label>
                                                        <input value="{{old('total_cotas_ganhador_top_five')}}" type="number" name="total_cotas_ganhador_top_five" class="form-control" id="total_cotas_ganhador_top_five" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="imagens-fill" role="tabpanel" aria-labelledby="imagens-tab-fill">
                                            <div class="col-12" >
                                                <input  type="file" class="form-control-file" name="file" multiple>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="whatsapp-fill" role="tabpanel" aria-labelledby="whatsapp-tab-fill">
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="has_botao_whatsapp">Botão whatsapp</label>
                                                    <div class="form-check form-switch">
                                                        <input value="{{old('has_botao_whatsapp')}}" type="checkbox" class="form-check-input" id="has_botao_whatsapp">
                                                        <label class="form-check-label" for="has_botao_whatsapp">Habilitar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="texto_botao_whatsapp">Texto do botão *</label>
                                                    <input value="{{old('texto_botao_whatsapp')}}" type="text" class="form-control" id="texto_botao_whatsapp">
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label" for="tipo_botao_whatsapp">Selecione uma opção *</label>
                                                    <select class="form-control" name="tipo_botao_whatsapp">
                                                        <option value="1">Contato</option>
                                                        <option value="2">Grupo</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label" for="contato_botao_whatsapp">Contato do Whatsapp *</label>
                                                    <input value="{{old('contato_botao_whatsapp')}}" type="text" class="form-control" id="contato_botao_whatsapp">
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label" for="id_grupo_botao_whatsapp">ID do grupo do Whatsapp *</label>
                                                    <input value="{{old('id_grupo_botao_whatsapp')}}" type="text" class="form-control" id="id_grupo_botao_whatsapp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="numero_sorteado-fill" role="tabpanel" aria-labelledby="numero_sorteado-tab-fill">
                                            <div class="mb-1">
                                                <label class="form-label" for="numero_sorteado">Número sorteado</label>
                                                <input value="{{old('numero_sorteado')}}" type="text" class="form-control" name="numero_sorteado" id="numero_sorteado">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="my-1 alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Enviar</button>



                                </div>
                            </div>
                        </form>
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
{{--    <script >--}}
{{--        console.log(Dropzone)--}}
{{--        let myDropzone = new Dropzone('#dpz-multiple-files', {--}}
{{--            url: "/teste",--}}
{{--            autoProcessQueue: false,--}}
{{--            maxFiles: 20,--}}
{{--            uploadMultiple:true,--}}


{{--        })--}}
{{--    </script>--}}
@endsection
