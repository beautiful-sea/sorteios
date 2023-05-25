<template>
    <div class="col-12 col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">
                    Método de Pagamento
                </h4>
            </div>
            <loader-helper v-if="loading"></loader-helper>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <select class="form-control" v-model="metodo.value">
                            <option value="MERCADO_PAGO">Mercado Pago</option>
                            <option value="PAGGUE">Paggue</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end ">
                    <button class="btn btn-primary" @click="salvarMetodoPagamento()">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            metodo: {
                value: ''
            },
            loading: false
        }
    },
    methods:{
        salvarMetodoPagamento(){
            this.loading = true;
            axios.post('/configuracoes/metodo-pagamento', {metodo_pagamento: this.metodo}).then((response) => {
                //toast de sucesso
                toastr. success('Método de pagamento padrão atualizado com sucesso!');

                this.loading = false;
            });
        },
        getMetodoPagamento(){
            this.loading = true;
            axios.get('/configuracoes/metodo-pagamento').then((response) => {
                this.metodo = response.data;
                this.loading = false;
            });
        }
    },
    mounted(){
        this.getMetodoPagamento();
    },
}
</script>

<style scoped>

</style>
