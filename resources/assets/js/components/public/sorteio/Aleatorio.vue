<template>
    <div class="app-vendas-express mb-2">
        <button @click="openModalCheckout()" v-if="qtdCotas>0" class="btn btn-success w-100 py-2 botaoCheckout removeFinalizado"
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

        <div class="app-card card mb-2">

            <div class="card-body text-center la_cor_3">

                <p class="text-muted font-xs mb-3 pt-2 la_cor_texto_1">Selecione a quantidade de números</p>

                <div class="numeros-select d-flex align-items-center justify-content-center flex-column">

                    <div class="vendasExpressNumsSelect">


                        <div v-for="numero in rifa.compra_automatica_numeros" class="item p-2 me-2 mb-2  flex-column la_cor_2" @click="addCota(numero)"><h3
                                class="mb-1 la_cor_texto_1"><small
                                class="text-dark font-xsss la_cor_texto_1">+</small>{{ numero }}</h3>

                            <p class="text-muted font-xss text-uppercase la_cor_texto_1">Selecionar</p>
                        </div>

                    </div>

                    <div class="vendasExpressNums d-flex align-items-center">

                        <div class="left pointer">

                            <div class="addNumero numeroChange text-muted" @click="removeCota()"><i
                                    class="bi bi-dash-circle la_cor_texto_1"></i>
                            </div>
                        </div>

                        <div class="center">
                            <input class="form-control text-center" id="qtdNumerosVisualiza"
                                   aria-label="Quantidade de números" readonly="" v-model="qtdCotas" placeholder="0">
                        </div>

                        <div class="right pointer">

                            <div class="removeNumero numeroChange text-muted" @click="addCota(1)"><i
                                    class="bi bi-plus-circle la_cor_texto_1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <public-modal-checkout :key="qtdCotas"></public-modal-checkout>
    </div>
</template>

<script>
export default {
    props:['rifa','mp_public_key'],
    name: "Aleatorio.vue",
    data(){
        return{
            qtdCotas:0
        }
    },
    computed:{
        valorTotal(){
            return this.qtdCotas * this.rifa.valor_por_numero;
        },
        //Valor total em formato R$ 0,00
        valorTotalReal(){
            return this.valorTotal.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        }
    },
    methods:{
        openModalCheckout(){

            if(this.rifa.has_compra_minima && this.qtdCotas < this.rifa.quantidade_minima_de_numeros){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Você precisa selecionar pelo menos '+this.rifa.quantidade_minima_de_numeros+' números!',
                })
                return;
            }
            //Quantidade maxima
            if(this.qtdCotas > this.rifa.quantidade_maxima_de_numeros){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Você não pode selecionar mais que '+this.rifa.quantidade_maxima_de_numeros+' números!',
                })
                return;
            }
            if(this.qtdCotas > 0){
                $('#modalCheckout').modal('show');
                return;
            }
        },
        addCota(qtd){
            this.qtdCotas += qtd;
        },
        removeCota(){
            if(this.qtdCotas > 0){
                this.qtdCotas--;
            }
        }
    }
}
</script>

<style scoped>

</style>
