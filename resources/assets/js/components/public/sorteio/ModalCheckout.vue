<template>
  <!-- Modal -->
    <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <loader-helper v-if="loading"></loader-helper>
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCheckoutTitle">Checkout</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body checkout" v-if="step === 1">

                    <div class="alert alert-info p-2 mb-2 font-xs msgCheckout"><i class="bi bi-check-circle"></i> Você
                        está adquirindo<span class="font-weight-500"> {{ qtdCotas }} número(s) </span>
                        <span> do sorteio </span>
                        <span class="font-weight-500">{{ rifa.titulo }}</span>, <span> seu pedido será efetivado assim que concluir a compra.</span>
                    </div>

                    <div class="mb-2">
                        <label for="telefone" class="form-label">Informe seu telefone <small
                                class="text-danger uc_telefone_checkout_erro"></small></label>
                        <input v-model="cliente.whatsapp" type="text" v-mask-phone class="form-control mascaraCelular"
                               id="uc_telefone_checkout"
                               name="uc_telefone_checkout" required="" value="" maxlength="14"
                               placeholder="(xx)xxxxx-xxxx" inputmode="numeric">
                    </div>

                    <div class="alert alert-warning p-2 font-xss mb-2"><i class="bi bi-exclamation-circle"></i> Informe
                        seu telefone para continuar.
                    </div>
                    <button typeof="submit" class="btn btn-primary btn-wide" id="botaoContiuarCheckout"
                            @click="verificarCadastroCliente()">Continuar <i
                            class="bi bi-arrow-right"></i></button>

                </div>
                <div class="modal-body checkout checkoutCadastro" v-if="step === 2" style="display: block;">

                    <div class="alert alert-info p-2 mb-2 font-xs msgCheckout"><i class="bi bi-check-circle"></i>
                        Você está adquirindo
                        <span class="font-weight-500"> {{ qtdCotas }} número(s) </span>
                        <span> do sorteio </span>
                        <span class="font-weight-500">{{ rifa.titulo }}</span>, <span> seu pedido será efetivado assim que concluir a compra.</span>
                    </div>


                    <div class="row mb-2 appForm">

                        <div class="col-12 mb-2">
                            <label for="nome" class="form-label">Nome completo <small
                                    class="text-danger uc_nome_erro"></small></label>
                            <input type="text" class="form-control" v-model="cliente.nome" id="uc_nome" name="uc_nome"
                                   required="" placeholder="Informe seu nome e sobrenome">
                        </div>


                        <div class="col-12 mb-2">
                            <label for="uc_telefone" class="form-label">Celular </label>
                            <input v-mask-phone class="form-control mascaraCelular ignore-loader" name="uc_telefone"
                                   v-model="cliente.whatsapp" id="uc_telefone"
                                   required="" disabled="" value="" inputmode="numeric">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="rtelefone" class="form-label">Confirme o celular <small
                                    class="text-danger uc_telefone_confirma_erro"></small></label>
                            <input class="form-control mascaraCelular" v-mask-phone v-model="cliente.confirm_whatsapp"
                                   name="uc_telefone_confirma" id="uc_telefone_confirma" required="" value=""
                                   maxlength="14" inputmode="numeric">
                        </div>

                        <div class="col-12 mb-2">

                            <div class="alert alert-warning p-2 font-xss mb-1"><i class="bi bi-exclamation-circle"></i>
                                Informe os dados corretos para recebimento das premiações.
                            </div>

                            <p class="font-xs mb-0">Ao realizar este pagamento e confirmar minha participação nesta ação
                                entre amigos, declaro ter lido e concordado com os <a class="font-weight-500"
                                                                                      href="/termos-de-uso">termos de
                                    uso</a> desta plataforma.</p>
                        </div>

                        <div class="col-12">
                            <span v-if="loading">Aguarde...</span>

                            <button v-else type="submit" class="btn btn-success ignore-loader w-100 btConcluiCompra"
                                    id="btConcluiCompra"
                                    disabled="disabled" @click="concluir()">Concluir cadastro e pagar <i
                                    class="bi bi-arrow-right-circle"></i></button>


                            <button @click="setStep(1)" type="button"
                                    class="btn btn-link w-100 btn-sm text-decoration-none mt-3 botaoCheckout removeFinalizado">
                                Já possuo uma conta
                            </button>
                        </div>
                    </div>
                </div>
                <div v-if="step === 3" class="modal-body checkout">
                    <div>
                        <h5>QrCode:</h5>
                        <img v-if="payment.metodo_pagamento === 'MERCADO_PAGO'"
                             :src="'data:image/png;base64,'+payment.qrcode" style="width: -webkit-fill-available;">
                        <img v-else :src="'/storage/qr_code/'+payment.qrcode" style="width: -webkit-fill-available;">
                    </div>
                    <!--                    Copiar chave pix:-->
                    <h5>Copie a chave pix abaixo e realize o pagamento:</h5>
                    <p><span style="word-break: break-all;">{{ payment.chave_pix }}</span></p>
                    <button @click="copiaChavePix()" class="btn btn-outline-secondary w-100 mb-2">
                        <svg class="svg-inline--fa fa-copy" aria-hidden="true" focusable="false" data-prefix="fas"
                             data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                             data-fa-i2svg="">
                            <path fill="currentColor"
                                  d="M224 0c-35.3 0-64 28.7-64 64V288c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H224zM64 160c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H288c35.3 0 64-28.7 64-64V384H288v64H64V224h64V160H64z"></path>
                        </svg><!-- <i class="fa fa-copy"></i> Font Awesome fontawesome.com --> Copiar chave pix
                    </button>
                    <div class="alert alert-warning p-2 font-xss mb-2"><i class="bi bi-exclamation-circle"></i> Após o
                        pagamento, clique no botão "Já realizei o pagamento" para confirmar o pagamento.
                    </div>
                    <button typeof="submit" class="btn btn-primary btn-wide" id="botaoContiuarCheckout"
                            @click="verifyPayment( )">
                        <span v-if="loading">Verificando...</span>
                        <span v-else>Já realizei o pagamento <i
                                class="bi bi-arrow-right"></i></span>
                    </button>
                </div>
                <div v-if="step === 4" class="modal-body checkout">
                    <!--                    Pagamento realizado-->
                    <div class="alert alert-success p-2 mb-2 font-xs msgCheckout"><i class="bi bi-check-circle"></i>
                        Pagamento realizado com sucesso.
                    </div>
                    <div class="alert alert-info p-2 font-xss mb-2"><i class="bi bi-exclamation-circle"></i> Aguarde o
                        sorteio.
                    </div>
                    <button typeof="submit" class="btn btn-primary btn-wide" id="botaoContiuarCheckout"
                            @click="closeModal()">Fechar <i
                            class="bi bi-arrow-right"></i></button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalCheckout",
    data() {
        return {
            rifa: this.$parent.rifa,
            qtdCotas: this.$parent.qtdCotas,
            selectedCotas: this.$parent.selectedCotas ?? [],
            step: 1,
            cliente: {
                nome: '',
                whatsapp: '',
                confirm_whatsapp: ''
            },
            payment: {
                pedido_id: null,
            },
            pedido: null,
            loading: false,
            verifying: false,
        }
    },
    watch: {
        //Valida o whatsapp e caso esteja diferente, desabilita o campo de confirmação e adiciona uma borda vermelha
        cliente: {
            handler() {
                if (this.cliente.whatsapp !== this.cliente.confirm_whatsapp) {
                    $('#btConcluiCompra').attr('disabled', true);
                    $('#uc_telefone_confirma').css('border-color', 'red');
                } else {
                    $('#btConcluiCompra').attr('disabled', false);
                    $('#uc_telefone_confirma').css('border-color', '#ced4da');
                }
            },
            deep: true
        },
    },

    methods: {
        copiaChavePix() {
            //copia a chave pix para a área de transferência
            //Se o navegador não suportar, coloca o valor da chave pix em um modal para o usuario copiar
            if (!navigator.clipboard)
                return Swal.fire({
                    title: 'Chave Pix',
                    html: '<p class="mb-0"><b>Copie a chave Pix abaixo e pague no aplicativo do seu banco:</b></p><p class="mb-0 font-weight-bold">' + this.payment.chave_pix + '</p>',
                    icon: 'info',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#28a745'
                })

            navigator.clipboard.writeText(this.payment.chave_pix);
            //Abre um Swall informando a chave pix copiada em pagamento.chave_pix e dizendo para pagar no aplicativo do banco dele
            Swal.fire({
                title: 'Chave Pix copiada!',
                text: 'Pague no aplicativo do seu banco usando a chave Pix: ' + this.payment.chave_pix,
                icon: 'success',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#28a745'
            })
        },
        closeModal() {
            $("#modalCheckout").modal('hide');
            $('.modal-backdrop').remove();
            self.resetModal();
        },
        resetModal() {
            this.step = 1;
            this.cliente = {
                nome: '',
                whatsapp: '',
                confirm_whatsapp: ''
            };
            this.payment = {
                pedido_id: null,
            };
            this.pedido = null;
            this.loading = false;
        },
        setStep(step) {
            this.step = step;
        },
        verifyPayment(silence = false) {
            let self = this;
            this.loading = false;
            Vue.requests.listar('/checkout/verify/' + this.payment.pedido_id, self, 'pedido', {
                    params: {
                        pedido_id: this.payment.pedido_id
                    },
                    loader: silence ? null : 'loading'
                }, function (response) {
                    if (response.status === 200) {
                        if (response.data.status === 'PAGO') {
                            //Ao clicar em OK, recarrega a pagina
                            Swal.fire({
                                title: 'Pagamento confirmado',
                                text: 'O pagamento foi confirmado com sucesso, aguarde o sorteio.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                            self.closeModal();

                        }
                        if (response.data.status === 'PENDENTE' && !silence) {
                            Swal.fire({
                                title: 'Aguardando pagamento',
                                text: 'O pagamento ainda não foi confirmado, aguarde a confirmação do pagamento.',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            })
                        }
                        self.verifying = false;
                    }
                }
            )
        },
        verificarCadastroCliente() {
            let self = this;
            Vue.requests.listar('/checkout/verificarCadastroCliente', self, null, {
                    params: {
                        cliente: JSON.stringify(this.cliente),
                        rifa_id: this.rifa.id
                    },
                    loader: 'loading'
                }, function (response) {
                    if (response.status === 200) {
                        self.step = 2;
                    }
                    if (response.status === 201) {
                        self.cliente.nome = response.data.nome_cliente;
                        self.cliente.whatsapp = response.data.telefone_cliente;
                        self.cliente.confirm_whatsapp = response.data.telefone_cliente;
                        self.concluir();
                    }
                }
            )
        },
        concluir() {
            let params = {
                rifa_id: this.rifa.id,
                qtdCotas: this.qtdCotas,
                cliente: JSON.stringify(this.cliente)
            }
            if (!this.rifa.is_compra_automatica) {
                params['selectedCotas'] = JSON.stringify(this.selectedCotas);
            }
            let self = this;
            Vue.requests.cadastrar(params, self, {
                url: '/checkout/cadastrar',
                loader: 'loading',
                toast: false
            }, function (response) {
                self.loading = false;
                if (response.status === 200) {
                    self.payment = response.data;
                    self.step = 3;

                    //Fica verificando se o pagamento foi confirmado a cada 5 segundos enquanto o step for 3. Não deixa repetir a verificação caso alguma verificação já esteja sendo feita
                    self.interval = setInterval(function () {
                        if (self.step === 3 && !self.verifying) {
                            self.verifying = true;
                            self.verifyPayment(true);
                        } else {
                            clearInterval(self.interval);
                            self.interval = null;
                            self.verifying = false;
                        }
                    }, 5000);
                }
                if (response.status === 400) {
                    Swal.fire({
                        title: 'Erro ao concluir',
                        text: response.data.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    // if(!self.rifa.is_compra_automatica){
                    //     self.selectedCotas = [];
                    //     self.$parent.reset();
                    //     //FEcha o modal checkout
                    //     self.closeModal();
                    // }
                    self.loading = false;
                }
            }, function () {
                Swal.fire({
                    title: 'Erro ao concluir',
                    text: response.data.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                // if(!self.rifa.is_compra_automatica){
                //     self.selectedCotas = [];
                //     self.$parent.reset();
                //     //FEcha o modal checkout
                //     self.closeModal();
                // }
                self.loading = false;
            });
        }
    },
    created() {
        let self = this;
        //OpenModalCheckout recebe o pedido como parametro
        this.$root.$on('openModalCheckout', function (pedido) {
            self.rifa = pedido.rifa;
            self.qtdCotas = pedido.cotas.length;
            self.payment.pedido_id = pedido.id;
            self.payment.chave_pix = pedido.chave_pix;
            self.payment.qrcode = pedido.qrcode;

            self.step = 3;
            $('#modalCheckout').modal('show');
        });
    },
    //Diretiva que mascara o celular no formato (99) 99999-9999
    directives: {
        'mask-phone': {
            bind(el) {
                // Aplica a máscara de telefone (99) 99999-9999 sem biblioteca do jquery mask
                el.oninput = function (e) {
                    if (!e.isTrusted) {
                        return;
                    }
                    if (this.value.length > 14) {
                        this.value = this.value.slice(0, 14);
                    }
                    if (this.value.length === 1) {
                        this.value = '(' + this.value;
                    }
                    if (this.value.length === 3) {
                        this.value = this.value + ')';
                    }
                    if (this.value.length === 9) {
                        this.value = this.value + '-';
                    }
                }
            },
            update(el) {
                // Reaplica a máscara de telefone quando o componente é atualizado
                el.oninput = function (e) {
                    if (!e.isTrusted) {
                        return;
                    }
                    if (this.value.length > 14) {
                        this.value = this.value.slice(0, 14);
                    }
                    if (this.value.length === 1) {
                        this.value = '(' + this.value;
                    }
                    if (this.value.length === 3) {
                        this.value = this.value + ')';
                    }
                    if (this.value.length === 9) {
                        this.value = this.value + '-';
                    }
                    console.log('length: ' + this.value.length);
                    e.value = this.value;
                }
                console.log('update: ', el.value);

            }
        }
    },
}
</script>

<style scoped>

</style>
