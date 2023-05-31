<template>
    <div class="row">
        <div class="col-12">
            <div class="app-title"><h1>Meus pedidos</h1>
            </div>
        </div>
        <div class="blocoListaSorteios">
            <div v-if="loading && !sorteios.length" class="text-center mt-3 mb-3 blocoLoader">
                <span class="loader"></span>
            </div>
            <div v-for="sorteio in sorteios" v-else>
                <div class="col-12 mb-2" @click="redirecionarPaginaSorteio(sorteio)">

                    <div class="SorteioTpl_sorteioTpl__2s2Wu   pointer">

                        <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">

                            <div
                                    style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                <img alt="250 PRA 20.000,00"
                                     src="https://static.carsdn.co/cldstatic/wp-content/uploads/chevrolet-corvette-z51-2020-01-exterior--front--red.jpg"
                                     style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                <noscript>
                                    <img alt="250 PRA 20.000,00" class="SorteioTpl_imagem__2GXxI" data-nimg="fill"
                                         decoding="async"
                                         loading="lazy"
                                         src="https://static.carsdn.co/cldstatic/wp-content/uploads/chevrolet-corvette-z51-2020-01-exterior--front--red.jpg"
                                         style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"/>
                                </noscript>
                            </div>
                        </div>

                        <div class="SorteioTpl_info__t1BZr" style="width: 70%; margin-top: 20px;">
                            <h1 class="SorteioTpl_title__3RLtu">{{ sorteio.rifa.titulo }} </h1>
                            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">
                                {{ sorteio.nome_cliente }}
                                {{ sorteio.telefone_cliente }} </h3>
                            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">Valor
                                da compra:
                                <b>{{ sorteio.valor_da_compra }}</b></h3>
                            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">Data
                                da compra: <b>
                                    {{ sorteio.created_at }} </b></h3>
                            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">
                                Status da compra:
                                <span class="badge bg-danger">{{ sorteio.status }}</span></h3>
                            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;"><b>Números:</b>
                            </h3>
                            <div style="overflow-x: auto">
                              <span class="badge bg-warning mb-1 me-1" v-for="cota in sorteio.rifa.cotas">
                                {{ cota.numero }}
                              </span>
                            </div>
                            <div style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal com titulo de Login e um campo "Informe seu telefone" e um botao "Continuar" -->
        <div id="modal-meus-numeros" aria-modal="true" class="modal fade show" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
                <div class="modal-content rounded-0">
                <span class="d-none">Usuário não autenticado
                </span>
                    <div class="modal-header"><h5 class="modal-title">Login</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body checkout">
                        <div class="alert alert-warning p-2 mb-2 font-xs msgAlerta" style="display: none;"></div>
                        <div class="mb-2">
                            <label class="form-label" for="telefone">Informe seu telefone <small
                                    class="text-danger uc_telefone_checkout_erro"></small></label>
                            <input id="uc_telefone_checkout" v-model="telefone" v-telefone
                                   class="form-control mascaraCelular" inputmode="numeric" maxlength="14"
                                   name="uc_telefone_checkout"
                                   placeholder="(xx)xxxxx-xxxx"
                                   required="" type="text" @blur="validarFormatoTelefone()">
                        </div>
                        <div class="alert alert-warning p-2 font-xss mb-2"><i class="bi bi-exclamation-circle"></i>
                            Informe seu
                            telefone para continuar.
                        </div>
                        <button id="botaoContiuarCheckout" class="btn btn-primary btn-wide" @click="getSorteios()">
                            Continuar <i
                                class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "MeusNumeros.blade.php",
    data() {
        return {
            sorteios: [],
            loading: true,
            telefone: '',
        };
    },
    methods: {
        redirecionarPaginaSorteio(sorteio) {
            window.location.href = "/sorteios/" + sorteio.rifa.id;
        },
        //Valida se o telefone está no formato: /(\d{0,2})(\d{0,5})(\d{0,4})/) e se possui 15 caracteres
        validarFormatoTelefone() {
            let telefone = this.telefone;
            let regex = /(\d{0,2})(\d{0,5})(\d{0,4})/;
            if (telefone.length === 14 && regex.test(telefone)) {
                //remove o alerta de erro
                $('.msgAlerta').html('').hide();
                return true;
            } else {
                this.telefone = '';
                $('.msgAlerta').html('Informe um telefone válido').show();
                return false;
            }
        },
        getSorteios() {
            //adiciona um loader no botao "cotinuar" enquanto a requisição é feita
            $('#botaoContiuarCheckout').html('<i class="bi bi-arrow-right"></i> Carregando...').attr('disabled', true);
            let params = {
                telefone: this.telefone
            };
            Vue.requests.listar('/buscarRifasPorTelefoneDoPedido', this, 'sorteios', {
                params: params,
                loader: 'loading'
            }, function (r) {
                //Se o usuário não tiver nenhum sorteio, mostrar uma mensagem "Você ainda não tem nenhum sorteio"
                if (r.data.length === 0) {
                    $('.msgAlerta').html('Você ainda não tem nenhum sorteio').show();
                }
                //fecha o modal
                $('#modal-meus-numeros').modal('hide');
                //remove o loader do botao "continuar"
                $('#botaoContiuarCheckout').html('Continuar <i class="bi bi-arrow-right"></i>').attr('disabled', false);
            });
        },
    },
    mounted() {
        //Ao abrir a página, abrir um modal com titulo de Login e um campo "Informe seu telefone" e um botao "Continuar"
        //Ao clicar no botao, fazer uma requisição para o backend, que irá trazer os sorteios do usuário
        //Se o usuário não tiver nenhum sorteio, mostrar uma mensagem "Você ainda não tem nenhum sorteio"
        //Se o usuário tiver sorteios, mostrar a lista de sorteios
        $('#modal-meus-numeros').modal('show');

        //Não deixa fechar o modal se nao informar o telefone e nao tiver nenhum sorteio
        $('#modal-meus-numeros').on('hidden.bs.modal', function (e) {
            if (this.sorteios.length === 0) {
                e.preventDefault();
                e.stopPropagation();
            }
        });

    },
    created() {
        Vue.directive('telefone', {
            bind: function (el) {
                el.oninput = function (e) {
                    if (!e.isTrusted) {
                        return;
                    }

                    let x = el.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                    el.value = !x[2] ? x[1] : '(' + x[1] + ')' + x[2] + (x[3] ? '-' + x[3] : '');
                }
            }
        })
    }
}
</script>

<style scoped>

</style>
