<template>
    <div id="raffletickets" class="app-vendas-express mb-2">
        <button @click="openModalCheckout()" v-if="selectedCotas.length>0"
                class="btn btn-success w-100 py-2 botaoCheckout removeFinalizado"
                style="position: fixed; bottom: 0; right: 0; left: 0; border-radius: 0; height: 60px; z-index:1; margin-top: 50px;">
            <div class="row align-items-center" style="line-height: 85%;">
                <div class="col pe-0 text-nowrap"><i
                        class="bi bi-check2-circle me-1"></i><span>Participar do sorteio</span></div>
                <div class="col-auto ps-0">
                    <div class="pe-3">
                        <div><span id="valorTotalCompraText"> {{ valorTotalReal }}</span></div>
                    </div>
                </div>
            </div>
        </button>
        <loader-helper v-if="loading"></loader-helper>
        <div class="row" role="header">
            <div class="col-auto mb-3">
                <div class="raffle-ticket-tabs btn-group">
                    <button class="btn btn-light active" data-count="583" data-title="Disponível"
                            data-type="available" type="button" @click="changeFilter('DISPONIVEL')">Disponível
                        ({{ disponiveis.length }})
                    </button>
                    <button class="btn btn-info" data-count="322" data-title="Reservado" data-type="reserved"
                            type="button" @click="changeFilter('RESERVADO')">Reservado ({{ reservados.length }})
                    </button>
                    <button class="btn btn-success" data-count="95" data-title="Pago" data-type="paid"
                            type="button" @click="changeFilter('PAGO')">Pago ({{ pagos.length }})
                    </button>
                </div>
            </div>
            <div class="col-auto mb-3">
                <div id="button-type-all" class="pl-0 btn btn-link font-weight-normal" data-type="all"
                     @click="changeFilter(null)"><i class="fa fa-check"></i> Mostrar todos
                </div>
            </div>
        </div>
        <div class="raffle-ticket-main" :style="(selectedCotas.length)?'margin-bottom: 145px':''">
            <ul class="raffle-ticket-container raffle-ticket--all">
                <li v-for="cota in cotasFiltered"
                    :class="'badge mb-1 mr-1 raffle-ticket-number raffle-ticket-number--'+getClassNumeroCota(cota)"
                    data-ticket-number="0"
                    data-ticket-status="reserved" @click="toggleCota(cota)">
                    <div class="numero-tooltip">Número {{ cota.numero_formatado }} reservado <br>por <b
                            class="text-warning">José</b></div>
                    {{ cota.numero_formatado }}
                </li>

            </ul>
        </div>
        <public-modal-checkout :key="selectedCotas.length"></public-modal-checkout>
    </div>

</template>
<script>
export default {
    props: ['rifa', 'mp_public_key'],
    data() {
        return {
            loading: false,
            cotas: [],
            selectedCotas: [],
            filter: 'DISPONIVEL'
        }
    },
    computed: {
        qtdCotas() {
            return this.selectedCotas.length;
        },
        total() {
            return this.rifa.valor_por_numero * this.selectedCotas.length;
        },
        valorTotalReal(){
            return this.total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        },
        cotasFiltered() {
            return this.filter ? this.cotas.filter((cota) => {
                return cota.status === this.filter
            }) : this.cotas;
        },
        disponiveis() {
            return this.cotas.filter((cota) => {
                return cota.status === 'DISPONIVEL'
            });
        },
        reservados() {
            return this.cotas.filter((cota) => {
                return cota.status === 'RESERVADO'
            });
        },
        pagos() {
            return this.cotas.filter((cota) => {
                return cota.status === 'PAGO'
            });
        }
    },
    methods: {
        reset() {
            this.selectedCotas = [];
            this.filter = 'DISPONIVEL';
            this.getCotas();
        },
        openModalCheckout() {

            if (this.rifa.has_compra_minima && this.selectedCotas.length < this.rifa.quantidade_minima_de_numeros) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Você precisa selecionar pelo menos ' + this.rifa.quantidade_minima_de_numeros + ' números!',
                })
                return;
            }
            //Quantidade maxima
            if (this.selectedCotas.length > this.rifa.quantidade_maxima_de_numeros) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Você não pode selecionar mais que ' + this.rifa.quantidade_maxima_de_numeros + ' números!',
                })
                return;
            }
            if (this.selectedCotas.length > 0) {
                $('#modalCheckout').modal('show');
                return;
            }
        },
        cotaIsSelected(cota) {
            return this.selectedCotas.find((cota_find) => {
                return cota_find.id === cota.id
            });
        },
        finalizar() {
            let self = this;
            const mp = new MercadoPago(this.mp_public_key, {
                locale: 'pt-BR'
            });

            let params = {
                cotas: JSON.stringify(this.selectedCotas),
                rifa_id: this.rifa.id
            }
            Vue.requests.cadastrar(params, this, {
                url: '/pedidos',
                toast: false
            }, function (r) {
                mp.checkout({
                    preference: {
                        id: r.data
                    },
                    autoOpen: true,
                });
            })


        },
        toggleCota(cota) {
            //Se a cota estiver reservada, não pode selecionar
            if (cota.status === 'RESERVADO'){
                toastr.error('Este número já está reservado!');
                return;
            };
            let exists = this.selectedCotas.find((cota_find) => {
                return cota_find.id === cota.id
            });

            if (exists) {
                this.selectedCotas = this.selectedCotas.filter((cota_filter) => {
                    return cota_filter.id !== cota.id
                });
                return;
            }
            this.selectedCotas.push(cota);
        },
        getClassNumeroCota(cota) {
            if (this.cotaIsSelected(cota)) return 'selected';
            if (cota.status === 'DISPONIVEL') return 'available';
            if (cota.status === 'RESERVADO') return 'reserved disabled';
            if (cota.status === 'PAGO') return 'paid disabled';
        },
        changeFilter(filter) {
            this.filter = filter
        },
        getCotas() {
            Vue.requests.listar('/cotas/' + this.rifa.id, this, 'cotas', {
                loader: 'loading',
            })
        }
    },
    created() {
        this.getCotas();
    },
    updated() {
    }
}
</script>

<style scoped>
#popfinalizar {
    -webkit-transition-delay: 0.1s;
    transition-delay: 0.1s;
    -webkit-transition: ease 0.1s all;
    -o-transition: ease 0.1s all;
    transition: ease 0.1s all;
    z-index: 1030 !important;
    color: #000;
}

.raffle-selected-numbers {
    position: fixed;
    width: 100%;
    display: none;
    left: 0;
    bottom: 0;
    transition: margin 0.3s ease-in-out;
    z-index: 6000;
    box-shadow: 0 0 40px 10px rgb(0 0 0 / 15%);
}

.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-flex;
    vertical-align: middle;
}

</style>
