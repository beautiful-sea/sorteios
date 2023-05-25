<template>
    <div class="row">
        <div class="col-12 ">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Lista de Usuários</h4>
                    <!-- botao cadastrar -->
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" @click="novoUsuario()">Cadastrar</button>
                    </div>
                </div>
                <loader-helper v-if="loading"></loader-helper>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data Cadastro</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="users.length" v-for="user in users">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at_formatado }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="setModalEditarUsuario(user)">Editar</button>
                                    <button class="btn btn-danger btn-sm" @click="deletarUsuario(user)">Excluir</button>
                                </td>
                            </tr>
                            <tr v-else class="text-center">
                                <td colspan="4">Nenhum usuário cadastrado</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalNovoUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Cadastrar Usuário</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <loader-helper v-if="loading"></loader-helper>
                        <div class="row">
                            <div class="col-12">
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="novoUser.name">
                            </div>
                            <div class="col-12">
                                <label>Email</label>
                                <input type="text" class="form-control" v-model="novoUser.email">
                            </div>
                            <div class="col-12">
                                <label>Senha</label>
                                <input type="password" class="form-control" v-model="novoUser.password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" @click="cadastrarUsuario()">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Editar Usuário</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <loader-helper v-if="loading"></loader-helper>
                        <div class="row">
                            <div class="col-12">
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="editUser.name">
                            </div>
                            <div class="col-12">
                                <label>Email</label>
                                <input type="text" class="form-control" v-model="editUser.email">
                            </div>
                            <div class="col-12">
                                <label>Senha</label>
                                <input type="password" class="form-control" v-model="editUser.password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" @click="salvarUsuario()">Salvar</button>
                    </div>
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
            novoUser:{
                name: '',
                email: '',
                password: '',
            },
            editUser: {
                name: '',
                email: '',
                password: '',
            },
            users: [],
            loading: false
        }
    },
    methods:{
        salvarUsuario(){
            this.loading = true;
            axios.put('/usuarios/' + this.editUser.id, this.editUser).then((response) => {
                //toast de sucesso
                toastr. success('Usuário salvo com sucesso!');
                this.getUsers();
                this.loading = false;
                $('#modalEditarUsuario').modal('hide');
            }).catch((error) => {
                let errors = error.response.data.errors;
                let htmlErros = '';
                Object.keys(errors).forEach(function (key) {
                    htmlErros += errors[key] + '<br>';
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: htmlErros,
                });
                this.loading = false;
            });
        },
        setModalEditarUsuario(user){
            this.editUser = user;
            $('#modalEditarUsuario').modal('show');
        },
        deletarUsuario(user){
            this.loading = true;
            //Swal de confirmacao
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Sair',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/usuarios/' + user.id).then((response) => {
                        //toast de sucesso
                        toastr. success('Usuário excluído com sucesso!');

                        this.getUsers();
                        this.loading = false;
                    }).catch((error) => {
                        //toast de erro
                        toastr. error(error.response.data.message);
                        this.loading = false;
                    });
                }else{
                    this.loading = false;
                }
            });
        },
        novoUsuario(){
            $('#modalNovoUsuario').modal('show');
        },
        cadastrarUsuario(){
            this.loading = true;
            axios.post('/usuarios', this.novoUser).then((response) => {
                //toast de sucesso
                toastr. success('Usuário cadastrado com sucesso!');

                this.getUsers();
                this.loading = false;
                $('#modalNovoUsuario').modal('hide');
                this.novoUser = {
                    name: '',
                    email: '',
                    password: '',
                };
            }).catch((error) => {
                let errors = error.response.data.errors;
                let htmlErros = '';
                for (let i in errors){
                    htmlErros += errors[i] + '<br>';
                }

                //Swal exibindo cada erro de validação laravel
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado!',
                    html: htmlErros,
                });
                this.loading = false;
            });
        },
        getUsers(){
            this.loading = true;
            axios.get('/usuarios').then((response) => {
                this.users = response.data;
                this.loading = false;
            });
        }
    },
    mounted(){
        this.getUsers();
    },
}
</script>

<style scoped>

</style>
