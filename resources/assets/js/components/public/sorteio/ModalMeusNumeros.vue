<template>
    <div class="modal fade" id="modal-consultaCompras">

        <div class="modal-dialog modal-dialog-centered modal-md">

            <div class="modal-content">

                <div class="modal-header"><h5 class="modal-title">Consulta de compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Celular *
                    </label>

                    <div class="input-group mb-2">
                        <input class="form-control mascaraCelular telefoneConsultaCompra"
                               aria-label="Número de telefone" id="tel" name="telefone" value="" maxlength="14"
                               placeholder="(xx)xxxxx-xxxx">
                        <button @keyup.enter="getPedidos()"  @click="getPedidos()" class="btn btn-secondary btConsultaCompra" type="submit"
                                id="button-addon2">

                            <div class=""><i class="bi bi-check-circle"></i>
                            </div>
                        </button>
                    </div>

                    <div class="text-center mt-3 mb-3 blocoLoader" style="display:none;">
                        <span class="loader"></span>
                    </div>

                    <div class="resultConsultaCompra">
                        <div v-for="pedido in pedidos">
                            <div class="card p-2 app-card mb-2 pointer border-bottom border-2 border-warning">
                                <div class="card-body" >

                                </div>
                                <div class="row align-items-center row-gutter-sm">
                                    <div class="col-auto">
                                        <div class="position-relative rounded-pill overflow-hidden box-shadow-08"
                                             style="width: 56px; height: 56px;">
                                            <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                                                <img :src="'/storage/'+pedido.rifa.imagem_principal.path" decoding="async" data-nimg="fill"
                                                     style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col ps-2">
                                        <div class="compra-title font-weight-500">{{ pedido.rifa.titulo }}</div>
                                        <br>
                                        <small>{{pedido.created_at_diff}}</small>
                                        <div class="d-flex" style="overflow-x: auto">
                                            <span class="badge bg-warning mb-1 me-1" v-for="cota in pedido.cotas">
                                              {{ cota.numero_formatado }}
                                            </span>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <span class="btn btn-warning btn-sm p-1 px-2 w-100 font-xss" v-if="pedido.status==='PENDENTE'" @click="openModalCheckout(pedido)">Efetuar pagamento <i
                                                    class="bi bi-chevron-right"></i>
                                            </span>
                                            <span class="btn btn-success btn-sm p-1 px-2 w-100 font-xss" v-if="pedido.status==='PAGO'">Pagamento confirmado <i
                                                class="bi bi-check-circle"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blocoPagamentoConsulta"></div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalMeusNumeros",
    data() {
        return {
            pedidos: [],
        }
    },
    methods: {
        copiaChavePix(){
            //copia a chave pix para a área de transferência
            //Se o navegador não suportar, coloca o valor da chave pix em um modal para o usuario copiar
            if(!navigator.clipboard)
                return Swal.fire({
                    title: 'Chave Pix',
                    html: '<p class="mb-0"><b>Copie a chave Pix abaixo e pague no aplicativo do seu banco:</b></p><p class="mb-0 font-weight-bold">'+this.pagamento.chave_pix+'</p>',
                    icon: 'info',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#28a745'
                })

            navigator.clipboard.writeText(this.pagamento.chave_pix);
            //Abre um Swall informando a chave pix copiada em pagamento.chave_pix e dizendo para pagar no aplicativo do banco dele
            Swal.fire({
                title: 'Chave Pix copiada!',
                text: 'Pague no aplicativo do seu banco usando a chave Pix: '+this.pagamento.chave_pix,
                icon: 'success',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#28a745'
            })
        },
        openModalCheckout(pedido){
            this.$root.$emit('openModalCheckout', pedido);
            //FEcha o modal atual
            $('#modal-consultaCompras').modal('hide');
        },
        getPedidos() {
            let telefone = $('.telefoneConsultaCompra').val();
            let _this = this;
            $('.blocoLoader').show();
            $('.resultConsultaCompra').html('');
            $('.blocoPagamentoConsulta').html('');
            axios.get('/pedidos/byWhatsapp?whatsapp=' + telefone).then(function (response) {
                $('.blocoLoader').hide();
                _this.pedidos = response.data;
                if (response.data.length === 0) {
                    $('.resultConsultaCompra').html('<div class="alert alert-danger" role="alert">Nenhum pedido encontrado</div>');
                }
            }).catch(function (error) {
                $('.blocoLoader').hide();
                $('.resultConsultaCompra').html('<div class="alert alert-danger" role="alert">Erro ao consultar compras</div>');
            });
        }
    },
    mounted() {
        //Mascara de telefone
        $('.mascaraCelular').mask('(00)00000-0000');
    }
}
</script>

<style scoped>

</style>
