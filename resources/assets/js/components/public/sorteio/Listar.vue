<template>
  <div class="row">
    <div class="col-12">
      <div class="app-title"><h1>Sorteios</h1>
      </div>
      <div class="app-card card mb-2">
        <div class="app-body d-flex align-items-center justify-content-center py-2"><p
            class="text-muted font-xs text-uppercase mb-0 me-2">Listar</p>
          <div aria-label="Filtros de listagem" class="btn-group btn-group-sm" role="group">
            <button :class="getClassTabStatus('EM_ANDAMENTO')" type="button" @click="setStatus('EM_ANDAMENTO')">Ativos
            </button>
            <button :class="getClassTabStatus('ENCERRADO')" type="button" @click="setStatus('ENCERRADO')">
              Concluídos
            </button>
            <button class="btn botaoLista botaoLista_3 btn-light" type="button">Em breve
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="sorteios.length && !loading" class="blocoListaSorteios">

      <div v-for="sorteio in sorteios" class="col-12 mb-2">
        <div @click="redirecionarPaginaSorteio(sorteio)" class="SorteioTpl_sorteioTpl__2s2Wu   pointer">

          <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">

            <div
                style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
              <img alt="250 PRA 20.000,00" class="SorteioTpl_imagem__2GXxI" data-nimg="fill" decoding="async" src=""
                   style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
              <noscript>
                <img :src="sorteio.primeira_imagem" alt="250 PRA 20.000,00" class="SorteioTpl_imagem__2GXxI"
                     data-nimg="fill"
                     decoding="async"
                     loading="lazy"
                     style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"/>
              </noscript>
            </div>
          </div>

          <div class="SorteioTpl_info__t1BZr" style="width: 70%;">
            <h1 class="SorteioTpl_title__3RLtu">{{ sorteio.titulo }}</h1>
            <h3 class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px; line-height: 1.4em;">Data do sorteio: <b>
              {{ sorteio.periodo_formatado }}
            </b></h3>
            <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
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
      status: "EM_ANDAMENTO",
      loading: false
    };
  },
  methods: {
    redirecionarPaginaSorteio(sorteio){
      window.location.href = "/sorteios/" + sorteio.id;
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
