<template>
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Buscar Pedido</h5>
                <span>Filtros para busca de pedidos</span>
            </div>

            <div class="card-body">
                <loader-helper v-if="loading"></loader-helper>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Por Sorteio: </label>
                            <select class="form-control" v-model="filtros.rifa_id" id="filtroSorteio">
                                <option value="">Selecione o sorteio</option>
                                <option v-for="rifa in rifas" :value="rifa.id">{{rifa.titulo}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Status do pedido: </label>
                            <select class="form-control" v-model="filtros.status" id="filtroStatus">
                                <option value="">Selecione o status</option>
                                <option value="PENDENTE">Pendente</option>
                                <option value="PAGO">Concluído</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>№ Pedido: </label>
                            <input type="number" v-model="filtros.id" class="form-control format-phone-number"
                                   id="filtroCodPedido" placeholder="Ex 8052" value="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Digite o Nome, E-mail ou Telefone do Cliente: </label>
                            <input type="text" v-model="filtros.search" class="form-control" name="format-currency"
                                   id="filtroDescricao" placeholder="Digite o Nome ou Telefone do Cliente" value="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>№ Sorteado: </label>
                            <input type="text" v-model="filtros.numero_sorteado" class="form-control" placeholder=""
                                   id="filtroNumeroSorteado" value="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <a id="btnbuscar" class="btn btn-primary btn-block" style="margin-top: 29px;"
                               @click="getPedidos"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Buscar</a>

                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <a id="btnlimpar" class="btn btn-light btn-block" style="margin-top: 29px;"
                               @click="resetFiltros"><i class="fa fa-ban"></i> &nbsp; Limpar Filtros</a>

                        </div>
                    </div>
                </div>
                <div v-if="withExtraOptions" class="d-flex mb-2">
                    <button class="btn btn-danger" @click="deletarTodosPendentes()">Apagar todos pendentes</button>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Sorteio</th>
                                    <th>Comprador</th>
                                    <th>Telefone</th>
                                    <th>Data / Hora</th>
                                    <th>Números</th>
                                    <th>Valor</th>
                                    <th>Whatsapp</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :class="pedido.status === 'PAGO'?'tr-pago':'tr-pendente'" v-if="pedidos.data.length" v-for="pedido in pedidos.data">
                                    <td>
                                        {{pedido.id}}
                                    </td>
                                    <td>
                                        {{pedido.rifa.titulo}}
                                    </td>
                                    <td>
                                        {{pedido.nome_cliente}}
                                    </td>
                                    <td>
                                        {{pedido.telefone_cliente}}
                                    </td>
                                    <td>
                                        {{pedido.created_at_data_hora}}
                                    </td>
                                    <td>
                                        {{pedido.cotas.length}}
                                    </td>
                                    <td>
                                        {{pedido.valor_da_compra_em_real}}
                                    </td>
                                    <td>
                                        <a :href="'https://api.whatsapp.com/send?phone=55'+pedido.telefone_cliente"
                                           target="_blank" class="btn chamar-whatsapp btn-success btn-sm">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            Chamar
                                        </a>
                                    </td>
                                    <td>
                                        <select class="form-control" v-model="pedido.status"
                                                @change="updateStatusPedido(pedido)">
                                            <option value="PENDENTE">Pendente</option>
                                            <option value="PAGO">Concluído</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span v-if="withExtraOptions" class="btn btn-danger mr-1 btn-sm" @click="deletarPedido(pedido)"><i
                                                class="fa fa-trash"></i></span>
                                            <span @click="setPedidoDetalhes(pedido)" class="btn btn-primary btn-sm"><i
                                                class="fa fa-eye"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="10" class="text-center">Nenhum pedido encontrado</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Detalhes do Pedido</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="pedido">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <b>Rifa: </b> <span>{{pedido.rifa.titulo}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Comprador: </b> <span>{{pedido.nome_cliente}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Telefone: </b> <span>{{pedido.telefone_cliente}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Data / Hora: </b> <span>{{pedido.created_at_data_hora}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Números: </b> <span>{{pedido.cotas.length}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Valor: </b> <span>{{pedido.valor_da_compra_em_real}}</span>
                            </div>
                            <div class="col-12 mb-2">
                                <b>Status: </b>
                                <select class="form-control" v-model="pedido.status"
                                        @change="updateStatusPedido(pedido)">
                                    <option value="PENDENTE">Pendente</option>
                                    <option value="PAGO">Concluído</option>
                                </select>
                            </div>
                            <div class="col-12 mb-2" v-if="pedido.cotas.length">
                                <b>Números escolhidos: </b>
                                <div class="d-flex" style="overflow-x: auto">
                                    <div class="m-1" v-for="cota in pedido.cotas">
                                        <span class="badge badge-success">{{cota.numero_formatado}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
      withExtraOptions:{
          type: Boolean,
          default: false
      }
    },
    name: "Pedidos",
    data() {
        return {
            pedidos: {
                data: []
            },
            filtros: {
                rifa_id: null,
                status: null,
                id: null,
                search: null,
                numero_sorteado: null
            },
            rifas: [],
            pedido: null,
            loading: false
        }
    },
    methods: {
        deletarTodosPendentes() {
            let self = this;
            //Swal de confirmação
            Swal.fire ({
                title: 'Tem certeza que deseja excluir todos os pedidos pendentes?',
                text: 'Esta ação não poderá ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Não, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    self.loading = true;
                    let params = {
                        _method: 'DELETE'
                    }
                    axios.delete('/pedidos/deletar-todos-pendentes', {params})
                        .then(response => {
                            self.loading = false;
                            self. getPedidos();
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Todos os pedidos pendentes foram excluídos!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                        })
                        .catch(error => {
                            self.loading = false;
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Ocorreu um erro ao excluir os pedidos pendentes!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        })
                }
            })
        },
        setPedidoDetalhes(pedido) {
            this.pedido = pedido;
            $('#modelId').modal('show');
        },
        deletarPedido(pedido) {
            let self = this;
            //Se o status do pedido for "PAGO" não pode excluir
            if (pedido.status === 'PAGO') {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Não é possível excluir um pedido que já foi pago!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return;
            }
            //Swal de confirmação
            Swal.fire ({
                title: 'Tem certeza que deseja excluir este pedido?',
                text: 'Esta ação não poderá ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Não, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    Vue.requests.deletar('/pedidos/' + pedido.id, self, null, {
                        loader: 'loading',
                    }, function (r) {
                        self.getPedidos();
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Pedido excluído com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    })
                }
            });
        },
        getRifas() {
            let self = this;
            Vue.requests.listar('/rifas?perPage=999999', self, null, {
                loader: 'loading',
            }, function (r) {
                self.rifas = r.data.data;
            })
        },
        resetFiltros() {
            this.filtros = {
                rifa_id: null,
                status: null,
                id: null,
                search: null,
                numero_sorteado: null
            }
        },
        getPedidos() {
            let self = this;
            let params = self.filtros;
            Vue.requests.listar('/pedidos', self, 'pedidos', {
                params,
                loader: 'loading',
            })
        },
        updateStatusPedido(pedido) {
            let self = this;
            let params = {
                status: pedido.status,
                id: pedido.id
            }
            Vue.requests.atualizar(params, self, {
                loader: 'loading',
                url: '/pedidos/',
                msg: 'Status atualizado com sucesso!'
            },function (r) {
                self.$root.$emit('atualizarEstatisticas');
                self.$root.$emit('atualizarPorcentagemVendasPorRifa');
            });
        }
    },
    mounted() {
        this.getRifas();
        this.getPedidos();

        //Ao fechar modal de detalhes do pedido, reseta o pedido
        $('#modelId').on('hidden.bs.modal', function () {
            this.pedido = null;
        })
    }
}
</script>

<style scoped>
 .tr-pago{
     background-color: #23853a !important;
     color: white;
     font-weight: 700;
 }
  .tr-pendente{
      background-color: #17a2b8ba !important;
      color: white;
      font-weight: 700;
  }

</style>
