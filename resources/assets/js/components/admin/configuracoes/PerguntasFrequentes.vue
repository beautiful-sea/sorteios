<template>
    <div class="col-12 mt-4 ">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">
                    Perguntas Frequentes
                </h4>
                <!-- botao cadastrar -->
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" @click="setNovaPergunta()">Cadastrar</button>
                </div>
            </div>
            <loader-helper v-if="loading"></loader-helper>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Ordem</th>
                            <th>Pergunta</th>
                            <th>Resposta</th>
                            <th>Data Cadastro</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="perguntas.length" v-for="pergunta in perguntas">
                            <td>{{ pergunta.ordem }}</td>
                            <td>{{ pergunta.pergunta }}</td>
                            <td>{{ pergunta.resposta }}</td>
                            <td>{{ pergunta.created_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="setModalEditarPergunta(pergunta)">Editar</button>
                                <button class="btn btn-danger btn-sm" @click="deletarPergunta(pergunta)">Excluir</button>
                            </td>
                        </tr>
                        <tr v-else class="text-center">
                            <td colspan="4">
                                Nenhum registro encontrado
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalNovaPergunta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Cadastrar Pergunta</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <loader-helper v-if="loading"></loader-helper>
                        <div class="row">
                            <div class="col-12">
                                <label>Ordem</label>
                                <input type="text" class="form-control" v-model="novaPergunta.ordem">
                            </div>
                            <div class="col-12">
                                <label>Pergunta</label>
                                <input type="text" class="form-control" v-model="novaPergunta.pergunta">
                            </div>
                            <div class="col-12">
                                <label>Resposta</label>
                                <textarea class="form-control" v-model="novaPergunta.resposta"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" @click="cadastrarPergunta()">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditarPergunta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Editar Pergunta</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <loader-helper v-if="loading"></loader-helper>
                        <div class="row">
                            <div class="col-12">
                                <label>Ordem</label>
                                <input type="text" class="form-control" v-model="editPergunta.ordem">
                            </div>
                            <div class="col-12">
                                <label>Pergunta</label>
                                <input type="text" class="form-control" v-model="editPergunta.pergunta">
                            </div>
                            <div class="col-12">
                                <label>Resposta</label>
                                <textarea class="form-control" v-model="editPergunta.resposta"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" @click="salvarPergunta()">Salvar</button>
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
            novaPergunta:{
                ordem: '',
                pergunta: '',
                resposta: '',
            },
            editPergunta: {
                id: '',
                ordem: '',
                pergunta: '',
                resposta: '',
            },
            perguntas: [],
            loading: false
        }
    },
    methods:{
        salvarPergunta(){
            this.loading = true;

            axios.put('/configuracoes/perguntas/' + this.editPergunta.id, this.editPergunta).then((response) => {
                //toast de sucesso
                toastr. success('Pergunta salva com sucesso!');

                this.getPerguntas();
                this.loading = false;
                $('#modalEditarPergunta').modal('hide');
            }).catch((error) => {
                //toast de erro
                toastr.error('Erro ao salvar pergunta!');
                this.loading = false;
            });
        },
        setModalEditarPergunta(pergunta){
            this.editPergunta = pergunta;
            $('#modalEditarPergunta').modal('show');
        },
        deletarPergunta(pergunta){
            this.loading = true;
            //Swal de confirmacao
            Swal.fire({
                title: 'Deseja realmente excluir a pergunta?',
                text: "Essa ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'Cancelar',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/configuracoes/perguntas/' + pergunta.id).then((response) => {
                        //toast de sucesso
                        toastr. success('Pergunta excluída com sucesso!');

                        this.getPerguntas();
                        this.loading = false;
                    }).catch((error) => {
                        //toast de erro
                        toastr.error('Erro ao excluir pergunta!');
                        this.loading = false;
                    });
                }
            })
        },
        setNovaPergunta(){
            this.novaPergunta = {
                ordem: '',
                pergunta: '',
                resposta: '',
            };
            $('#modalNovaPergunta').modal('show');
        },
        cadastrarPergunta(){
            this.loading = true;

            axios.post('/configuracoes/perguntas', this.novaPergunta).then((response) => {
                //toast de sucesso
                toastr. success('Pergunta cadastrada com sucesso!');

                this.getPerguntas();
                this.loading = false;
                $('#modalNovaPergunta').modal('hide');
            }).catch((error) => {
                //toast de erro
                toastr.error('Erro ao cadastrar pergunta!');
                this.loading = false;
            });
        },
        getPerguntas(){
            this.loading = true;
            axios.get('/configuracoes/perguntas').then((response) => {
                this.perguntas = response.data;
                this.loading = false;
            }).catch((error) => {
                //toast de erro
                toastr.error('Erro ao carregar perguntas!');
                this.loading = false;
            });
        }
    },
    mounted(){
        this.getPerguntas();
    },
}
</script>

<style scoped>

</style>
