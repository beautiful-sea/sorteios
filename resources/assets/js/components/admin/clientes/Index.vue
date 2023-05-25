<template>
    <div class="row">
        <loader-helper v-if="loading"></loader-helper>
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Buscar Cliente</h5>
                    <span>Filtros para busca de clientes</span>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Por Sorteio: </label>
                                <select v-model="filtroSorteio" class="form-control" id="filtroSorteio">
                                    <option value="">Selecione o sorteio</option>
                                    <option v-for="sorteio in sorteios" :value="sorteio.id">{{ sorteio.titulo }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Digite o Nome ou Telefone do Cliente: </label>
                                <input v-model="filtroSearch" type="text" class="form-control" name="format-currency"
                                       id="filtroDescricao" placeholder="Digite o Nome, E-mail ou Telefone do Cliente"
                                       value="">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <a class="btn btn-primary btn-block" @click="lista()"><i
                                        class="fa-solid fa-magnifying-glass"></i> &nbsp; Buscar</a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <a class="btn btn-light btn-block" @click="limpaFiltro()"><i
                                        class="fa-solid fa-ban"></i> &nbsp; Limpar Filtros</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <a class="btn btn-success btn-block" @click="geraCSV()"><i
                                        class="fa-solid fa-file-text"></i> &nbsp; Gerar arquivo CSV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Clientes
                        <span v-if="clientes.total" class="badge badge-primary">{{ clientes.total }}</span>
                    </h5>
                    <span>
                        Clientes cadastrados no sistema
                    </span>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Data Cadastro</th>
                                    <th>Whatsapp</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="clientes.data" v-for="cliente in clientes.data">
                                    <td>{{ cliente.nome_cliente }}</td>
                                    <td>{{ cliente.telefone_cliente_formatado }}</td>
                                    <td>{{ cliente.created_at_data_hora }}</td>
                                    <td>
                                        <a v-if="cliente.telefone_cliente"
                                           :href="'https://api.whatsapp.com/send?phone=55'+cliente.telefone_cliente"
                                           target="_blank"
                                           class="btn btn-success btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                            Chamar</a>
                                        <a v-else class="btn btn-secondary btn-sm disabled"><i
                                                class="fa-brands fa-whatsapp"></i> Chamar</a>
                                    </td>
                                    <td>
                                        <span class="btn btn-primary btn-sm" @click="setClienteModal(cliente)">
                                            <i class="fa-solid fa-eye"></i> &nbsp; Visualizar
                                        </span>
                                        <span class="btn btn-primary btn-sm" @click="setClienteModalEditar(cliente)">
                                            <i class="fa-solid fa-edit"></i> &nbsp; Editar
                                        </span>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="text-center">Nenhum registro encontrado</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDetalhesCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Detalhes do Cliente</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="cliente">
                        <loader-helper v-if="loadingPedidos"></loader-helper>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label>Data cadastro: {{ cliente.created_at_data_hora }}</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label>Nome: {{ cliente.nome_cliente }}</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label>Telefone: {{ cliente.telefone_cliente_formatado }}</label>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="form-group mb-0">
                                    <label><b>Histórico de pedidos</b></label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Sorteio</th>
                                        <th class="text-center">Qtd. Números</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Data cadastro</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-if="cliente.pedidos.length" v-for="pedido in cliente.pedidos">
                                        <td>{{ pedido.rifa.titulo }}</td>
                                        <td class="text-center">{{ pedido.cotas.length }}</td>
                                        <td>{{ pedido.valor_da_compra_em_real }}</td>
                                        <td>
                                            <span class="badge badge-success"
                                                  v-if="pedido.status == 'PAGO'">Concluído</span>
                                            <span class="badge badge-info"
                                                  v-if="pedido.status == 'PENDENTE'">Pendente</span>
                                        </td>
                                        <td>{{ pedido.created_at_data_hora }}</td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="5" class="text-center">Nenhum registro encontrado</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId"></h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col-12">
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="cliente.nome_cliente">
                            </div>
                            <div class="col-12 mt-2">
                                <label>Telefone</label>
                                <input type="text" class="form-control mascaraCelular" v-model="cliente.novo_telefone_cliente">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button @click="salvarCliente" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    data() {
        return {
            cliente: {
                nome_cliente: null,
                telefone_cliente: null,
                novo_telefone_cliente: null,
                pedidos: []
            },
            clientes: {
                data: []
            },
            sorteios: [],
            filtroSorteio: null,
            filtroSearch: null,
            loading: false,
            loadingPedidos: false,
        }
    },
    methods: {
        setClienteModalEditar(cliente){
            this.cliente = cliente;
            this.cliente.novo_telefone_cliente = cliente.telefone_cliente;
            //Abre modal
            $('#modalEditarCliente').modal('show');
            //Mascara de celular
            $('.mascaraCelular').mask('(00) 00000-0000');

        },
        salvarCliente() {
            this.loading = true;
            let params = {
                nome_cliente: this.cliente.nome_cliente,
                telefone_cliente: this.cliente.novo_telefone_cliente
            }
            axios.put('/clientes/' + this.cliente.telefone_cliente, params)
                .then(response => {
                    this.loading = false;
                    $('#modalEditarCliente').modal('hide');
                    this.lista();
                })
                .catch(error => {
                    //Para cada erro de validação do Laravel, exibe um toastr
                    if (error.response.status === 422) {
                        Object.keys(error.response.data.errors).forEach(function (key) {
                            toastr.error(error.response.data.errors[key][0]);
                        })
                    }
                    this.loading = false;
                });
        },
        getPedidosCliente() {
            this.loadingPedidos = true;
            axios.get('/clientes/' + this.cliente.telefone_cliente + '/pedidos')
                .then(response => {
                    this.cliente['pedidos'] = response.data;
                    this.loadingPedidos = false;
                })
                .catch(error => {
                    console.log(error);
                    this.loadingPedidos = false;
                });
        },
        setClienteModal(cliente) {
            this.cliente = cliente;
            this.getPedidosCliente();
            $('#modalDetalhesCliente').modal('show');
        },

        listaSorteios() {
            this.loading = true;
            axios.get('/rifas?perPage=99999')
                .then(response => {
                    this.sorteios = response.data.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        lista() {
            let params = {
                rifa_id: this.filtroSorteio,
                search: this.filtroSearch
            }
            let url = '/clientes?';
            if (params.rifa_id) {
                url += 'rifa_id=' + params.rifa_id + '&';
            }
            if (params.search) {
                url += 'search=' + params.search + '&';
            }
            this.loading = true;
            axios.get(url)
                .then(response => {
                    this.clientes = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        limpaFiltro() {
            this.filtroSorteio = '';
            this.filtroSearch = '';
            this.lista();
        },
        geraCSV() {
            this.loading = true;
            let params = {
                rifa_id: this.filtroSorteio,
                search: this.filtroSearch
            }
            let url = '/clientes/geraCSV?';
            if (params.rifa_id) {
                url += 'rifa_id=' + params.rifa_id + '&';
            }
            if (params.search) {
                url += 'search=' + params.search + '&';
            }
            axios.get(url)
                .then(response => {
                    //A response.data vem com o csv
                    var blob = new Blob([response.data], {type: 'text/csv'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'clientes.csv';
                    link.click();
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.listaSorteios();
        this.lista();
        //Quando o modal fechar, limpa o cliente
        $('#modalDetalhesCliente').on('hidden.bs.modal', function () {
            this.cliente = {
                nome_cliente: null,
                telefone_cliente: null,
                pedidos: []
            }
        }.bind(this))
    },
}
</script>

<style scoped>

</style>
