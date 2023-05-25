<template>
  <!-- Card Perfil -->
  <div class="card">
      <loader-helper v-if="loading"></loader-helper>
      <div class="card-header">
          <h3 class="card-title">Editar</h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <label>Nome</label>
                <input type="text" class="form-control" v-model="user.name">
            </div>
            <div class="col-12">
                <label>E-mail</label>
                <input type="text" disabled class="form-control" v-model="user.email">
            </div>
            <div class="col-12">
                <label>Senha</label>
                <input type="password" class="form-control" v-model="user.password">
            </div>
            <div class="col-12">
                <label>Confirmação de Senha</label>
                <input type="password" class="form-control" v-model="user.password_confirmation">
            </div>
        </div>
          <div class="d-flex justify-content-end">
              <button class="btn btn-primary" @click="updateUser">Salvar</button>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    name: "Perfil",
    data() {
        return {
            user:{
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            loading: false
        }
    },
    methods:{
        getUser(){
            this.loading = true;
            axios.get('/perfil').then(response => {
                this.user = response.data;
                this.loading = false;
            });
        },
        updateUser(){
            this.loading = true;
            axios.put('/perfil', this.user).then(response => {
                this.loading = false;
                this.toastr.success('Perfil atualizado com sucesso!');
            }).catch(error => {
                this.loading = false;
                if(!error.response){
                    this.toastr.success('Perfil atualizado com sucesso!');

                }
                //Exibe um Swal com cada erro do Laravel
                if (error.response.status === 422) {
                    var errors = error.response.data.errors;
                    var msg = '';
                    $.each(errors, function (i, error) {
                        msg += error[0] + '<br>';
                    });
                    Swal.fire({
                        title: 'Ops...',
                        html: msg,
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            }).finally(() => {
                this.loading = false;
                this.user.password = '';
                this.user.password_confirmation = '';
            });
        }
    },
    mounted(){
        this.getUser();
    }
}
</script>

<style scoped>

</style>
