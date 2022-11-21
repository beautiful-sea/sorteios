<template>
    <div v-if="dados.data && dados.data.length" id="card-item-pagination mx-2" class="mt-3"
         :style="styles">
        <div>
            <div class="d-flex" style="align-items: center;">
                <span style="white-space: nowrap;">Mostrando {{ dados.next_page_url ? (dados.to - dados.per_page) + 1 : (dados.to + 1) - dados.data.length }} a {{ dados.to }} de {{ dados.total }}  </span>
                <span class="px-1">|</span>
                <select v-model="rootScope[porPagina]" class="form-control"
                        style="padding: 0px 5px;margin: 0px 5px;height: 30px"
                        @change="getResults()">
                    <option v-if="![10,20,50,100,500,1000].includes(Number(rootScope[porPagina]))">{{rootScope[porPagina]}}</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                    <option>500</option>
                    <option>1000</option>
                </select>
                itens
            </div>
        </div>

        <pagination :data="dados" @pagination-change-page="getResults"  :limit="2" :show-disabled="true">
            <span slot="prev-nav">Anterior</span>
            <span slot="next-nav">Próximo</span>
            <span slot="current-nav"></span>
        </pagination>
    </div>
</template>

<script>
    export default {
        props:['data','perPage', 'onChangePage','estilo'],
        data(){
          return {

          }
        },
        computed:{
            dados(){
                return this.data
            },
            rootScope(){
                return this.$parent;
            },
            porPagina(){
                return this.perPage??'perPage';
            },
            styles(){
                return this.estilo ?? 'display: flex;justify-content: space-between' ;
            }
        },
        methods:{
            getResults(page = 1) {
                if (this.onChangePage) {
                    this.onChangePage(page)
                }
            }
        },
        updated(){
            let domElement = this.$el;
            $(domElement).find('.pagination li.active>a>span').html('');
        }
    }
</script>

