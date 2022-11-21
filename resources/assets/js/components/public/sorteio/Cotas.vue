<template>
    <div id="raffletickets">
        <div>
            <h4 style="font-weight: 900; font-size: 23px "><span
                style="border-left: 6px solid green; margin-right: 10px;"></span>COTAS</h4>
            <p style="font-size: 18px">Clique e selecione quantas cotas você quiser!</p>
        </div>

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
                <button class="btn btn-danger" data-target="#modal-ticket-search" data-toggle="modal" type="button">Ver
                    meus números
                </button>
            </div>
            <div class="col-auto mb-3">
                <div id="button-type-all" class="pl-0 btn btn-link font-weight-normal" data-type="all"
                     @click="changeFilter(null)"><i class="fa fa-check"></i> Mostrar todos
                </div>
            </div>
        </div>
        <div class="raffle-ticket-main" :style="(selectedCotas.length)?'margin-bottom: 145px':''">
            <ul class="raffle-ticket-container raffle-ticket--all">
                <li v-for="cota in cotasFiltered" :class="'badge mb-1 mr-1 raffle-ticket-number raffle-ticket-number--'+getClassNumeroCota(cota.status)"
                    data-ticket-number="0"
                    data-ticket-status="reserved" @click="toggleCota(cota)">
                    <div class="numero-tooltip">Número 000 reservado <br>por <b
                        class="text-warning">José</b></div>
                    {{ cota.numero }}
                </li>

            </ul>
        </div>
        <div v-show="selectedCotas.length" id="popfinalizar" class="raffle-selected-numbers bg-white py-3"
             style="bottom: 0px; display: block;">
            <div class="m-4">
                <div class="row justify-content-center align-items-center">
                    <div id="checkout_ticket_numbers" style="max-height: 200px; overflow-y: auto" class="col-md col-12">
                        <ul class="p-0">
                            <li @click="toggleCota(cota)" v-for="cota in selectedCotas" class="raffle-ticket-number raffle-ticket-number--selected d-inline-block badge mb-1 mr-1"
                                style="min-width:70px;">{{ cota.numero }}
                            </li>
                        </ul>
                    </div>
                    <div id="checkout_text_price" class="col-md-auto col" v-if="rifa.valor_por_numero">{{ selectedCotas.length }}x
                        {{ rifa.valor_por_numero.toFixed(2) }} = <b><h5>R$ {{ total }}</h5></b></div>
                    <div class="col-md-auto col text-right finalizarmp">
                        <button @click="finalizar()" id="btnFinalizar" class="btn btn-warning" data-target="#checkoutmodal" data-toggle="modal" type="button">
                            <i class="fa fa-check"></i> Finalizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props: ['rifa','mp_public_key'],
    data() {
        return {
            loading: false,
            cotas: [],
            selectedCotas: [],
            filter: 'DISPONIVEL'
        }
    },
    computed: {
        total(){
          return (this.rifa.valor_por_numero * this.selectedCotas.length).toFixed(2);
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
        finalizar(){
            let self = this;
            const mp = new MercadoPago(this.mp_public_key, {
                locale: 'pt-BR'
            });

            let params  = {
                cotas:JSON.stringify(this.selectedCotas),
                rifa_id:this.rifa.id
            }
            Vue.requests.cadastrar(params,this,{
                url:'/pedidos',
                toast:false
            },function (r) {
                console.log(r.data)
                mp.checkout({
                    preference: {
                        id: r.data
                    },
                    autoOpen: true,
                });
            })


        },
        toggleCota(cota) {
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
        getClassNumeroCota(status) {
            if (status === 'DISPONIVEL') return 'available';
            if (status === 'RESERVADO') return 'reserved disabled';
            if (status === 'PAGO') return 'paid disabled';
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

.btn-group > .btn:not(:last-child):not(.dropdown-toggle), .btn-group > .btn-group:not(:last-child) > .btn {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.btn-light:not(:disabled):not(.disabled):active, .btn-light:not(:disabled):not(.disabled).active, .show > .btn-light.dropdown-toggle {
    color: #212529;
    background-color: #dae0e5;
    border-color: #d3d9df;
}

.btn-group > .btn:focus, .btn-group > .btn:active, .btn-group > .btn.active, .btn-group-vertical > .btn:focus, .btn-group-vertical > .btn:active, .btn-group-vertical > .btn.active {
    z-index: 1;
}

.btn-group > .btn, .btn-group-vertical > .btn {
    position: relative;
    flex: 1 1 auto;
}

button:not(:disabled), [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled) {
    cursor: pointer;
}

.btn {
    box-shadow: none !important;
    font-weight: 600;
}

.btn-light {
    color: #212529;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}

.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>
