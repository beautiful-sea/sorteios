<template>
    <div class="row">
        <div class="col-12">
            <div class="app-title"><h1>Sorteios</h1>
            </div>
            <div class="app-card card mb-2">
                <div class="app-body d-flex align-items-center justify-content-center py-2">
                    <div aria-label="Filtros de listagem" class="btn-group btn-group-sm" role="group">
                        <button :class="getClassTabStatus(null)" type="button"
                                @click="setStatus(null)">Todos
                        </button>
                        <button :class="getClassTabStatus('EM_ANDAMENTO')" type="button"
                                @click="setStatus('EM_ANDAMENTO')">Ativos
                        </button>
                        <button :class="getClassTabStatus('ENCERRADO')" type="button" @click="setStatus('ENCERRADO')">
                            Concluídos
                        </button>
                        <button   :class="getClassTabStatus('EM_BREVE')" @click="setStatus('EM_BREVE')" type="button">Em breve
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="sorteios.length && !loading" class="blocoListaSorteios">
            <div  class="col-12 mb-2"  @click="redirecionarPaginaSorteio(sorteioPrincipal)">
                <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR  pointer">
                    <div class="SorteioTpl_imagemContainer__2-pl4 col-auto blocoImagemSlide">
                        <div id="carouselSorteio63bc967f0ad56" class="carousel slide carousel-dark carousel-fade"
                             data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active imagemSlide blocoImagemSlide"
                                     style="width:100%;height:290px">
                                    <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                        <img :alt="sorteioPrincipal.titulo" :src="'/storage/'+sorteioPrincipal.imagem_principal.path" decoding="async"
                                             data-nimg="fill" class="SorteioTpl_imagem__2GXxI"
                                             style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                        <noscript><img :alt="sorteioPrincipal.titulo" src=" " decoding="async"
                                                       data-nimg="fill"
                                                       style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                                                       class="SorteioTpl_imagem__2GXxI" loading="lazy"/></noscript>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="SorteioTpl_info__t1BZr"><h1 class="SorteioTpl_title__3RLtu">{{ sorteioPrincipal.titulo }}</h1>
                        <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px">
                            {{sorteioPrincipal.resumo}}
                        </p>
                        <span class="badge bg-success blink bg-opacity-75 font-xsss" v-if="sorteioPrincipal.status === 'EM_ANDAMENTO'">Adquira já!</span>
                        <span class="badge bg-info blink bg-opacity-75 font-xsss" v-if="sorteioPrincipal.status === 'EM_BREVE'">Em breve!</span>
                        <span class="badge bg-dark blink bg-opacity-75 font-xsss" v-if="sorteioPrincipal.status === 'ENCERRADO'">Concluído!</span>
                    </div>
                </div>
            </div>

            <div v-for="sorteio in sorteios" class="col-12 mb-2">

                <div v-if="!sorteio.is_principal" @click="redirecionarPaginaSorteio(sorteio)" class="SorteioTpl_sorteioTpl__2s2Wu   pointer">

                    <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">

                        <div
                                style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                            <img alt="250 PRA 20.000,00" class="SorteioTpl_imagem__2GXxI" data-nimg="fill"
                                 decoding="async" :src="'/storage/'+sorteio.imagem_principal.path"
                                 style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                            <noscript>
                                <img :src="sorteio.primeira_imagem" alt="250 PRA 20.000,00"
                                     class="SorteioTpl_imagem__2GXxI"
                                     data-nimg="fill"
                                     decoding="async"
                                     loading="lazy"
                                     style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"/>
                            </noscript>
                        </div>
                    </div>

                    <div class="SorteioTpl_info__t1BZr" style="width: 70%;">
                        <h1 class="SorteioTpl_title__3RLtu">{{ sorteio.titulo }}</h1>
                        <h3 v-if="sorteio.mostrar_data_sorteio" class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">Data do
                            sorteio: <b>
                                {{ sorteio.periodo_formatado }}
                            </b></h3>
                        <span class="badge bg-success blink bg-opacity-75 font-xsss" v-if="sorteio.status === 'EM_ANDAMENTO'">Adquira já!</span>
                        <span class="badge bg-info blink bg-opacity-75 font-xsss" v-if="sorteio.status === 'EM_BREVE'">Em breve!</span>
                        <span class="badge bg-dark blink bg-opacity-75 font-xsss" v-if="sorteio.status === 'ENCERRADO'">Concluído!</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="col-12">
            <div v-if="!loading" class="app-card card mb-2">
                <div class="app-body d-flex align-items-center justify-content-center py-2">
                    <p class="text-muted font-xs text-uppercase mb-0 me-2">Nenhum sorteio encontrado</p>
                </div>
            </div>
            <div v-else class="app-card card mb-2">
                <div class="app-body d-flex align-items-center justify-content-center py-2">
                    <p class="text-muted font-xs text-uppercase mb-0 me-2">Carregando sorteios...</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Listar.vue",
    data() {
        return {
            sorteios: [],
            status: null,
            loading: false
        };
    },
    computed: {
        sorteioPrincipal() {
            //Retorna o sorteio que possui atributo is_principal = true
            let principal = this.sorteios.find(sorteio => sorteio.is_principal);
            return principal ? principal : this.sorteios[0];
        }
    },
    methods: {
        redirecionarPaginaSorteio(sorteio) {
            window.location.href = "/sorteios/" + sorteio.slug;
        },
        getClassTabStatus(tab_status) {
            if (this.status == tab_status) {
                return " btn botaoLista botaoLista_2 btn-info";
            } else {
                return " btn botaoLista botaoLista_2 btn-light";
            }
        },
        setStatus(status) {
            this.status = status;
            this.listarSorteios();
        },
        listarSorteios() {
            let params = {
                status: this.status,
            };
            Vue.requests.listar("/sorteios", this, 'sorteios', {
                loader: 'loading',
                params: params
            })
        },
    },
    mounted() {
        this.listarSorteios();
    },
}
</script>

<style scoped>

</style>
