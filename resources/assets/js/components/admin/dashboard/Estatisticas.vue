<template>
    <div class="row">
        <loader-helper v-if="loading"></loader-helper>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pedidos Pagos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{dados.pedidos_pagos}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pedidos Pendentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{dados.pedidos_pendentes}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total de Pedidos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{dados.total_pedidos}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Usuários Cadastrados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{dados.usuarios_cadastrados}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Estatisticas",
    data(){
        return {
            dados: {
                pedidos_pagos: 0,
                pedidos_pendentes: 0,
                total_pedidos: 0,
                usuarios_cadastrados: 0,
            },
            loading: false,
        }
    },
    methods: {
        getDados(){
            this.loading = true;
            axios.get('/dashboard/estatisticas')
                .then((response) => {
                    this.dados = response.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mounted(){
        this.getDados();
        this.$root.$on('atualizarEstatisticas', () => {
            this.getDados();
        });
    },
}
</script>

<style scoped>

</style>
