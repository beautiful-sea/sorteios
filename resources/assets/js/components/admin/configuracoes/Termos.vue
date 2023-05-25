<template>
  <div class="col-12 col-md-6">
      <div class="card ">
          <div class="card-header">
              <h4 class="card-title">Termos de Uso</h4>
          </div>
          <loader-helper v-if="loading"></loader-helper>
          <div class="card-body">
              <div class="row mb-4">
                  <div class="col-12">
                      <textarea class="form-control" rows="10" v-model="termos.value"></textarea>
                  </div>
              </div>
              <div class="d-flex justify-content-end ">
                  <button class="btn btn-primary" @click="salvarTermos()">Salvar</button>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: "Termos",
    data(){
        return {
            termos: {
                value: ''
            },
            loading: false
        }
    },
    methods:{
        salvarTermos(){
            this.loading = true;
            axios.post('/configuracoes/termos-de-uso', {termos: this.termos}).then((response) => {
                //toast de sucesso
                toastr. success('Termos de uso atualizado com sucesso!');

                this.loading = false;
            });
        },
        getTermos(){
            this.loading = true;
            axios.get('/configuracoes/termos-de-uso').then((response) => {
                this.termos = response.data;
                this.loading = false;
            });
        }
    },
    mounted(){
        this.getTermos();
    },
}
</script>

<style scoped>

</style>
