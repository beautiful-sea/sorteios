<template>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Total de vendas por rifa
                </h6>
            </div>
            <div class="card-body" style="min-height:320px;">
                <loader-helper v-if="loading"></loader-helper>
               <div v-for="rifa in vendas" >
                   <h4 class="small font-weight-bold">{{ rifa.titulo }}<span
                           class="float-right">{{ rifa.porcentagem_vendas }}%</span></h4>
                   <div class="progress mb-4">
                       <div class="progress-bar" role="progressbar" :style="'width: '+rifa.porcentagem_vendas+'%;background-color: '+rifa.color+';'"
                            :aria-valuenow="rifa.porcentagem_vendas" aria-valuemin="0" aria-valuemax="100"></div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PorcentagemVendasPorRifa",
    data() {
        return {
            loading: false,
            vendas: [],
        }
    },
    methods:{
        getPorcetagemVendasPorRifa(){
            this.loading = true;
            axios.get('/dashboard/porcentagem-vendas-por-rifa')
                .then((response) => {
                    this.vendas = response.data;
                    //Para cada venda, gera um campo color com uma cor aleatória
                    this.vendas.forEach((item) => {
                        item.color = '#'+Math.floor(Math.random()*16777215).toString(16);
                    });
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                });
        }
    },
    mounted() {
        this.getPorcetagemVendasPorRifa();
        this.$root.$on('atualizarPorcentagemVendasPorRifa', () => {
            this.getPorcetagemVendasPorRifa();
        });
    }
}
</script>

<style scoped>

</style>
