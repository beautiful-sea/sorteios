<template>
    <div>
        <span @click="openModal" style="cursor:pointer;">
            <slot name="icone">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </slot>
        </span>
<!--        <div class="modal fade text-start modal-warning show" :id="'modal-confirm-action_'+id" tabindex="-1" aria-labelledby="myModalLabel140" aria-modal="true" role="dialog">-->
<!--            <div class="modal-dialog modal-dialog-centered">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="myModalLabel140">Confirmação</h5>-->
<!--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <slot>Tem certeza que deseja confirmar essa ação? ela não podera ser desfeita</slot>-->
<!--                    </div>-->

<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-flat-danger waves-effect" data-bs-dismiss="modal" @click="decline">Cancelar</button>-->
<!--                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal" @click="accept">Confirmar</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    props:['onAccept','onDecline', 'descricao'],
    data(){
        return {
            id : Math.floor(Math.random() * 1000000)
        }
    },
    computed:{
        dados(){
            return this.data
        },
        rootScope(){
            return this.$parent;
        },
        desc(){
            return this.descricao || "Deseja realmente executar essa ação? uma vez executado não poderá ser desfeita."
        },

    },
    methods:{
        openModal(){
            let self = this;

            Swal.fire({
                title: "Confirmar",
                html: this.desc,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                showLoaderOnConfirm: true,
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                buttonsStyling: false,
                // loaderHtml: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden"></span></div>',
                customClass : {
                    confirmButton: 'btn btn-primary waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-flat-danger waves-effect me-1',
                },
                preConfirm: () => {
                    return self.onAccept()
                        .then(response => {
                            return response
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if(result.value?.error == true){
                        let htmlMsgErro = result.value?.response?.responseText;
                        if( result.value?.response?.data) {
                            htmlMsgErro = result.value.response.data.errors.join('<br>');
                        }

                        Swal.fire({title:'Ops !!!', html: htmlMsgErro, icon : 'error'})
                    }
                    else{
                        Swal.fire({title:'Sucesso !!!', icon : 'success', timer:1300, showConfirmButton:false})
                    }
                }
            })

            // $('#modal-confirm-action_'+this.id).modal('show');
        },
        async accept() {
            if (this.onAccept) {
                let response  =  await this.onAccept()

                // $('#modal-confirm-action_'+this.id).modal('hide');

                if(response?.error == true){
                    let htmlMsgErro = response?.response?.responseText;
                    if( response?.response?.data) {
                        htmlMsgErro = response.response.data.errors.join('<br>');
                    }

                    Swal.fire({title:'Ops !!!', html: htmlMsgErro, icon : 'error'})
                }
                else{
                    Swal.fire({title:'Sucesso !!!', icon : 'success', timer:1300, showConfirmButton:false})
                }

            }
        },
        decline() {
            if (this.onDecline) {
                // $('#modal-confirm-action_'+this.id).modal('hide');
                this.onDecline();
            }
        }
    },
    updated(){
        let domElement = this.$el;
    }
}
</script>
