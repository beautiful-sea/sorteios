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
    <link rel="stylesheet" type="text/css" href="/css/base/plugins/forms/form-file-uploader.css">
    <!-- Adicione o CSS do Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@endsection
@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informações da rifa</h4>
                        <small>Preencha todos os dados para cadastrar uma nova rifa</small>
                    </div>
                    <div class="card-body">
                        <form action="/rifas/{{$rifa->id}}" method="post" class="form" enctype="multipart/form-data"
                              id="formRifa">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="titulo">Título</label>
                                        <input value="{{$rifa->titulo}}" type="text" id="titulo" class="form-control"
                                               name="titulo">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="resumo">Resumo</label>
                                        <input value="{{$rifa->resumo}}" type="text" id="resumo" class="form-control"
                                               name="resumo">
                                    </div>
                                </div>
                                <div class="  col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="descricao">Descrição</label>
                                        <div style="max-height: 200px;" id="editor">
                                            {!! $rifa->descricao !!} <!-- Aqui você pode carregar o conteúdo existente do campo, se necessário -->
                                        </div>
                                        <textarea type="text" style="display: none" id="descricao" class="form-control" name="descricao">
                                        {!! $rifa->descricao !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="card-body" style="min-height: 400px">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dados-tab-fill" data-bs-toggle="tab"
                                               href="#dados-fill" role="tab" aria-controls="dados-fill"
                                               aria-selected="true">Dados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="configuracoes-tab-fill" data-bs-toggle="tab"
                                               href="#configuracoes-fill" role="tab" aria-controls="configuracoes-fill"
                                               aria-selected="false">Configurações</a>
                                        </li>
                                        {{--                                        <li class="nav-item">--}}
                                        {{--                                            <a class="nav-link" id="top_five-tab-fill" data-bs-toggle="tab" href="#top_five-fill" role="tab" aria-controls="top_five-fill" aria-selected="false">Top Five</a>--}}
                                        {{--                                        </li>--}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="imagens-tab-fill" data-bs-toggle="tab"
                                               href="#imagens-fill" role="tab" aria-controls="imagens-fill"
                                               aria-selected="false">Imagens</a>
                                        </li>
                                        {{--                                        <li class="nav-item">--}}
                                        {{--                                            <a class="nav-link" id="whatsapp-tab-fill" data-bs-toggle="tab" href="#whatsapp-fill" role="tab" aria-controls="whatsapp-fill" aria-selected="false">Whatsapp</a>--}}
                                        {{--                                        </li>--}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="numero_sorteado-tab-fill" data-bs-toggle="tab"
                                               href="#numero_sorteado-fill" role="tab"
                                               aria-controls="numero_sorteado-fill" aria-selected="false">Número
                                                Sorteado</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content pt-1">
                                        <div class="tab-pane active" id="dados-fill" role="tabpanel"
                                             aria-labelledby="dados-tab-fill">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="premio">Prêmio </label>
                                                        <input value="{{$rifa->premio}}" type="text" id="premio"
                                                               class="form-control" name="premio">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="status">Status da rifa</label>
                                                        <select class="form-control" name="status">
                                                            <option @if($rifa->status === 'EM_ANDAMENTO') selected
                                                                    @endif value="EM_ANDAMENTO">Em andamento
                                                            </option>
                                                            <option @if($rifa->status === 'EM_BREVE') selected
                                                                    @endif value="EM_BREVE">Em breve
                                                            </option>
                                                            <option @if($rifa->status === 'ENCERRADO') selected
                                                                    @endif value="ENCERRADO">Encerrado
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="mostrar_data_sorteio">Informar
                                                            data do sorteio</label>
                                                        <div class="form-check form-switch">
                                                            <input value="1"
                                                                   @if($rifa->mostrar_data_sorteio) checked="checked"
                                                                   @endif type="checkbox" class="form-check-input" name="mostrar_data_sorteio"
                                                                   id="mostrar_data_sorteio">
                                                            <label class="form-check-label" for="mostrar_data_sorteio">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="periodo">Data do sorteio </label>
                                                        <input value="{{$rifa->periodo}}" type="datetime-local"
                                                               id="periodo" class="form-control" name="periodo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="valor_por_numero">Valor por
                                                            número (R$) </label>
                                                        <input value="{{number_format($rifa->valor_por_numero,2,',','.')}}" type="text"
                                                               id="valor_por_numero" class="form-control"
                                                               name="valor_por_numero">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="quantidade_de_numeros">Quantidade
                                                            de Números </label>
                                                        <input value="{{$rifa->quantidade_de_numeros}}" type="number"
                                                               id="quantidade_de_numeros" class="form-control"
                                                               name="quantidade_de_numeros">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="quantidade_maxima_de_numeros">Quantidade
                                                            máxima de Números </label>
                                                        <input value="{{$rifa->quantidade_maxima_de_numeros}}"
                                                               type="number" id="quantidade_maxima_de_numeros"
                                                               class="form-control" name="quantidade_maxima_de_numeros">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="quantidade_minima_de_numeros">Quantidade
                                                            mínima de Números </label>
                                                        <input value="{{$rifa->quantidade_minima_de_numeros}}"
                                                               type="number" id="quantidade_mínima_de_numeros"
                                                               class="form-control" name="quantidade_minima_de_numeros">
                                                    </div>
                                                </div>
                                                {{--                                                <div class="col-md-6 col-12">--}}
                                                {{--                                                    <div class="mb-1">--}}
                                                {{--                                                        <label class="form-label" for="porcentagem_comissao_vendas">Porcentagem de comissão por vendas (%)</label>--}}
                                                {{--                                                        <input value="{{old('porcentagem_comissao_vendas')}}" type="number" id="porcentagem_comissao_vendas" class="form-control" name="porcentagem_comissao_vendas" >--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="has_compra_minima">Compra
                                                            mínima</label>
                                                        <div class="form-check form-switch">
                                                            <input value="1" name="has_compra_minima"
                                                                   @if($rifa->has_compra_minima) checked="checked"
                                                                   @endif type="checkbox" class="form-check-input"
                                                                   id="has_compra_minima">
                                                            <label class="form-check-label" for="has_compra_minima">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="col-md-6 col-12">--}}
                                                {{--                                                    <div class="mb-1">--}}
                                                {{--                                                        <label class="form-label" for="contato_whatsapp">Contato do whatsapp </label>--}}
                                                {{--                                                        <input value="{{old('contato_whatsapp')}}" type="text" id="contato_whatsapp" class="form-control" name="contato_whatsapp" >--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="configuracoes-fill" role="tabpanel"
                                             aria-labelledby="configuracoes-tab-fill">
                                            <div class="row">
                                                <div class="  col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="is_compra_automatica">Habilitar
                                                            compra automática?</label>
                                                        <div class="form-check form-switch">
                                                            <input name="is_compra_automatica" value="1" @if($rifa->is_compra_automatica) checked
                                                                   @endif type="checkbox" class="form-check-input"
                                                                   id="is_compra_automatica">
                                                            <label class="form-check-label" for="is_compra_automatica">Habilitar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <label>Números compra automática </label>
                                                    <div class="d-flex">
                                                        <button id="add-numero-compra-automatica"
                                                                style="border-radius: 10px 0px 0px 10px;" type="button"
                                                                class="btn btn-info ml-2"><i class="fa fa-plus"></i>
                                                        </button>
                                                        <div class="row" id="numeros-compra-automatica">
                                                            @if($rifa->is_compra_automatica)
                                                                @foreach($rifa->compra_automatica_numeros as $compra_automatica_numero)
                                                                    <div class="col-12">
                                                                        <div class="d-flex justify-content-between"><input
                                                                                    style="border-radius:0px;height: auto"
                                                                                    type="number"
                                                                                    disabled
                                                                                    name="compra_automatica_numeros[]"
                                                                                    class="form-control"
                                                                                    value="{{$compra_automatica_numero}}"
                                                                                    placeholder="Quantidade de números">
                                                                            <button style="    border-radius: 0px 10px 10px 0px"
                                                                                    class="btn btn-danger" type="button"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="is_principal">Sorteio
                                                            principal?</label>
                                                        <div class="form-check form-switch">
                                                            <input value="1" @if($rifa->is_principal) checked
                                                                   @endif type="checkbox" name="is_principal"
                                                                   class="form-check-input" id="is_principal">
                                                            <label class="form-check-label"
                                                                   for="is_principal">Sim</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="tab-pane" id="top_five-fill" role="tabpanel" aria-labelledby="top_five-tab-fill">--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-12">--}}
                                        {{--                                                    <div class="mb-1">--}}
                                        {{--                                                        <label class="form-label" for="has_top_five">Top Five</label>--}}
                                        {{--                                                        <div class="form-check form-switch">--}}
                                        {{--                                                            <input value="{{old('has_top_five')}}" type="checkbox" class="form-check-input" id="has_top_five">--}}
                                        {{--                                                            <label class="form-check-label" for="has_top_five">Habilitar</label>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-12">--}}
                                        {{--                                                    <div class="mb-1">--}}
                                        {{--                                                        <label class="form-label" for="premio_top_five">O que o primeiro lugar vai ganhar? </label>--}}
                                        {{--                                                        <input value="{{old('premio_top_five')}}" type="text" name="premio_top_five" class="form-control" id="premio_top_five" placeholder="Um Pix de R$ 1.500,00">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class=" col-12">--}}
                                        {{--                                                    <div class="mb-1">--}}
                                        {{--                                                        <label class="form-label" for="definir_ganhador_top_five">Definir Ganhador?</label>--}}
                                        {{--                                                        <div class="form-check form-switch">--}}
                                        {{--                                                            <input value="{{old('definir_ganhador_top_five')}}" type="checkbox" class="form-check-input" id="definir_ganhador_top_five">--}}
                                        {{--                                                            <label class="form-check-label" for="definir_ganhador_top_five">Habilitar</label>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}

                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="tab-pane" id="imagens-fill" role="tabpanel"
                                             aria-labelledby="imagens-tab-fill">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <div class="form-group files">
                                                        <input type="file" id="images" class="form-control-file"
                                                               name="files[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="images-list" class="row">
                                                @foreach($rifa->imagens as $rifa_imagem)
                                                    <div class="col-12 col-md-3">
                                                        <div class="images-principal-option">
                                                            <label class="form-check-label"
                                                                   for="principal">Principal</label>
                                                            <input @if($rifa_imagem->is_principal) checked
                                                                   @endif style="cursor:pointer" type="radio"
                                                                   name="imagem_principal" id="principal"></div>
                                                        <img style="width: 100%;height: 150px; object-fit: cover;"
                                                             src="{{\Illuminate\Support\Facades\Storage::url($rifa_imagem->path)}}"
                                                             class="img-fluid rounded me-1 mb-1">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="imagem_principal_index"
                                                   value="{{$rifa->imagens->where('is_principal',true)->keys()->first()}}"
                                                   name="imagem_principal_index">
                                        </div>

                                        {{--                                        <div class="tab-pane" id="whatsapp-fill" role="tabpanel" aria-labelledby="whatsapp-tab-fill">--}}
                                        {{--                                            <div class="col-12">--}}
                                        {{--                                                <div class="mb-1">--}}
                                        {{--                                                    <label class="form-label" for="has_botao_whatsapp">Botão whatsapp</label>--}}
                                        {{--                                                    <div class="form-check form-switch">--}}
                                        {{--                                                        <input value="{{old('has_botao_whatsapp')}}" type="checkbox" class="form-check-input" id="has_botao_whatsapp">--}}
                                        {{--                                                        <label class="form-check-label" for="has_botao_whatsapp">Habilitar</label>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-12">--}}
                                        {{--                                                <div class="mb-1">--}}
                                        {{--                                                    <label class="form-label" for="texto_botao_whatsapp">Texto do botão </label>--}}
                                        {{--                                                    <input value="{{old('texto_botao_whatsapp')}}" type="text" class="form-control" id="texto_botao_whatsapp">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="mb-1">--}}
                                        {{--                                                    <label class="form-label" for="tipo_botao_whatsapp">Selecione uma opção </label>--}}
                                        {{--                                                    <select class="form-control" name="tipo_botao_whatsapp">--}}
                                        {{--                                                        <option value="true">Contato</option>--}}
                                        {{--                                                        <option value="2">Grupo</option>--}}
                                        {{--                                                    </select>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="mb-1">--}}
                                        {{--                                                    <label class="form-label" for="contato_botao_whatsapp">Contato do Whatsapp </label>--}}
                                        {{--                                                    <input value="{{old('contato_botao_whatsapp')}}" type="text" class="form-control" id="contato_botao_whatsapp">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="mb-1">--}}
                                        {{--                                                    <label class="form-label" for="id_grupo_botao_whatsapp">ID do grupo do Whatsapp </label>--}}
                                        {{--                                                    <input value="{{old('id_grupo_botao_whatsapp')}}" type="text" class="form-control" id="id_grupo_botao_whatsapp">--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="tab-pane" id="numero_sorteado-fill" role="tabpanel"
                                             aria-labelledby="numero_sorteado-tab-fill">
                                            <div class="mb-1 col-12">
                                                <h3>Número sorteado</h3>
                                                <input value="{{$rifa->numero_sorteado}}" type="text"
                                                       class="form-control" name="numero_sorteado" id="numero_sorteado">
                                            </div>
                                            @if($rifa->ganhador)
                                           <div class="col-12">
                                               <h3>Dados do ganhador</h3>
                                           </div>
                                            <div class=" col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="nome_ganhador_top_five">Nome do
                                                        ganhador </label>
                                                    <input disabled value="{{$rifa->ganhador->nome_cliente}}" type="text"
                                                           name="nome_ganhador_top_five" class="form-control"
                                                           id="nome_ganhador_top_five">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="telefone_ganhador_top_five">Telefone
                                                        do ganhador </label>
                                                    <input disabled value="{{$rifa->ganhador->telefone_cliente}}" type="text"
                                                           name="telefone_ganhador_top_five" class="form-control"
                                                           id="telefone_ganhador_top_five">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="total_cotas_ganhador_top_five">Total
                                                        de cotas compradas </label>
                                                    <input disabled value="{{count($rifa->ganhador->cotas)}}"
                                                           type="number" name="total_cotas_ganhador_top_five"
                                                           class="form-control" id="total_cotas_ganhador_top_five">
                                                </div>
                                            </div>
                                                @endif
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
                                    <button type="submit"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Salvar
                                    </button>


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
    <script src="{{ asset('vendors/js/maskMoney/jquery.maskMoney.min.js') }}"></script>
    <!-- Adicione o Quill.js -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection
@section('page-script')
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        var textarea = document.querySelector('textarea[name="descricao"]');
        quill.on('text-change', function() {
            textarea.value = quill.root.innerHTML;
        });

        //Quando uma ou mais imagens são selecionadas, adiciona o preview na div #images-list
        $('#images').on('change', function () {
            var files = $(this)[0].files;
            var imagesList = $('#images-list');
            imagesList.empty();
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (e) {
                    let div = $('<div>').addClass('col-12 col-md-3');
                    let div2 = $('<div>').addClass('images-principal-option');
                    let label = $('<label>').addClass('form-check-label').attr('for', 'principal').html('Principal');
                    let input = $('<input style="cursor:pointer">').attr('type', 'radio').attr('name', 'imagem_principal').attr('id', 'principal').data('imagem_numero', i);
                    var img = $('<img style="width: 100%;height: 150px; object-fit: cover;">').attr('src', e.target.result).addClass('img-fluid rounded me-1 mb-1');
                    div.append(div2);
                    div2.append(label);
                    div2.append(input);
                    div.append(img);
                    imagesList.append(div);
                    //Primeira imagem vem marcada como principal
                    if (i === 0) {
                        input.attr('checked', true);
                        //seta imagem_principal_index com o index da imagem principal
                        $('#imagem_principal_index').val(input.data('imagem_numero'));
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        //Quando uma imagem principal é selecionada, seta o valor do input imagem_principal_index
        $(document).on('change', 'input[name="imagem_principal"]', function () {
            $('#imagem_principal_index').val($(this).data('imagem_numero'));
        });

        //Cria uma mascara de dinheiro para #valor_por_numero
        $(document).ready(function () {
            $('#valor_por_numero').maskMoney({
                prefix: 'R$ ',
                decimal: ',',
                thousands: '.',

            });
        });

        //Adiciona um novo campo de número
        $(document).on('click', '#add-numero-compra-automatica', function () {
            let div = $('<div>').addClass('col-12');
            let input = $('<input style="border-radius:0px;height: auto">').attr('type', 'number').attr('name', 'compra_automatica_numeros[]').addClass('form-control').attr('placeholder', 'Quantidade de números');

            //Botao de remover
            let button = $('<button style="    border-radius: 0px 10px 10px 0px">').addClass('btn btn-danger ').attr('type', 'button').html('<i class="fa fa-trash"></i>');
            button.click(function () {
                div.remove();
            });
            //Adiciona o botao de remover na mesma linha que o input usando uma div d-flex
            let divInput = $('<div>').addClass('d-flex justify-content-between');
            divInput.append(input);
            divInput.append(button);
            div.append(divInput);

            $('#numeros-compra-automatica').append(div);
        });

        @if(session()->has('message'))
        toastr.success('{{session()->get('message')}}');
        @endif

        //Exibe os erros do laravel no toastr
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{$error}}');
        @endforeach
        @endif
    </script>
@endsection
<style>
    .images-principal-option {
        position: absolute;
        width: -webkit-fill-available;
        background-color: black;
        height: 23px;
        bottom: 4px;
        display: flex;
        justify-content: space-evenly;
        left: 0;
        margin: auto 12px;
        border-radius: 0px 0px 4px 4px;
    }

    .files input {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        padding: 120px 0px 85px 35%;
        text-align: center !important;
        margin: 0;
        width: 100% !important;
    }

    .files input:focus {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        border: 1px solid #92b0b3;
    }

    .files {
        position: relative
    }

    .files:after {
        pointer-events: none;
        position: absolute;
        top: 60px;
        left: 0;
        width: 50px;
        right: 0;
        height: 56px;
        content: "";
        background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
        display: block;
        margin: 0 auto;
        background-size: 100%;
        background-repeat: no-repeat;
    }

    .color input {
        background-color: #f1f1f1;
    }

    .files:before {
        position: absolute;
        bottom: 10px;
        left: 0;
        pointer-events: none;
        width: 100%;
        right: 0;
        height: 57px;
        content: "Ou arraste e solte suas imagens aqui ";
        display: block;
        margin: 0 auto;
        color: #2ea591;
        font-weight: 600;
        text-transform: capitalize;
        text-align: center;
    }
</style>
