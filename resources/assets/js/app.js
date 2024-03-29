
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Dropzone from "dropzone/dist/dropzone";
import requests from "./scripts/helpers/requests";
import helpers from "./scripts/helpers/helpers";
import { createPopper } from '@popperjs/core';
import axios from "axios";


//Jquery
window.$ = window.jQuery = require('jquery');
//Jquery mask
require('jquery-mask-plugin');
//Bootstrap
require('./bootstrap');
// window.bootstrap = require('bootstrap');

require('hideshowpassword');
// var Dropzone = require('dropzone');
var password = require('password-strength-meter');

window.Vue = require('vue');
window.axios = axios;

axios.defaults.baseURL = '/api/front/';
window.Swal = require('sweetalert2');
window.toastr = require('toastr');
const pluginRequest = {
    install () {
        Vue.requests = requests
        Vue.prototype.$requests = requests
    }
}

Vue.use(pluginRequest)

const pluginHelpers = {
    install () {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
    }
}
Vue.use(pluginHelpers)

Dropzone.autoDiscover = true;



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('loader-helper', require('./components/helpers/Loader').default);
Vue.component('paginacao-helper', require('./components/helpers/Paginacao').default);

Vue.component('public-sorteio-aleatorio', require('./components/public/sorteio/Aleatorio.vue').default);
Vue.component('public-sorteio-cotas', require('./components/public/sorteio/Cotas.vue').default);
Vue.component('public-sorteios-listar', require('./components/public/sorteio/Listar.vue').default);
Vue.component('public-meus-numeros', require('./components/public/sorteio/MeusNumeros.vue').default);
Vue.component('public-modal-checkout', require('./components/public/sorteio/ModalCheckout.vue').default);
Vue.component('public-modal-meus-numeros', require('./components/public/sorteio/ModalMeusNumeros.vue').default);
Vue.component('users-count', require('./components/UsersCount.vue').default);

Vue.component('admin-dashboard-estatisticas', require('./components/admin/dashboard/Estatisticas.vue').default);
Vue.component('admin-dashboard-pedidos', require('./components/admin/dashboard/Pedidos.vue').default);
Vue.component('admin-dashboard-grafico-ganhos-mensais', require('./components/admin/dashboard/GraficoGanhosMensais.vue').default);
Vue.component('admin-dashboard-porcentagem-vendas-por-rifa', require('./components/admin/dashboard/PorcentagemVendasPorRifa.vue').default);

Vue.component('admin-clientes', require('./components/admin/clientes/Index.vue').default);
Vue.component('admin-perfil', require('./components/admin/Perfil.vue').default);
Vue.component('admin-configuracao-termos', require('./components/admin/configuracoes/Termos.vue').default);
Vue.component('admin-configuracao-metodo-pagamento', require('./components/admin/configuracoes/MetodoDePagamento.vue').default);
Vue.component('admin-configuracao-perguntas-frequentes', require('./components/admin/configuracoes/PerguntasFrequentes.vue').default);
Vue.component('admin-usuarios', require('./components/admin/usuarios/Index.vue').default);


const app = new Vue({
    el: '#app'
});

$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    },

    /**
     * Remove element classes with wildcard matching. Optionally add classes:
     *   $( '#foo' ).alterClass( 'foo-* bar-*', 'foobar' )
     *
     */
    alterClass: function(removals, additions) {
        var self = this;

        if(removals.indexOf('*') === -1) {
            // Use native jQuery methods if there is no wildcard matching
            self.removeClass(removals);
            return !additions ? self : self.addClass(additions);
        }

        var patt = new RegExp( '\\s' +
                removals.
                    replace( /\*/g, '[A-Za-z0-9-_]+' ).
                    split( ' ' ).
                    join( '\\s|\\s' ) +
                '\\s', 'g' );

        self.each(function(i, it) {
            var cn = ' ' + it.className + ' ';
            while(patt.test(cn)) {
                cn = cn.replace( patt, ' ' );
            }
            it.className = $.trim(cn);
        });

        return !additions ? self : self.addClass(additions);
    }
});
