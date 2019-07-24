
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'
import VueRouter from 'vue-router'


Vue.use(VueRouter);
Vue.use(ElementUI, { locale });


const routes = [
    {
        path: '/editar', component: require('./components/ComponentesForm/DataEdit.vue')
    }
]

const router = new Vue({
    routes
}) 

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('data-component',require('./components/ComponentesForm/DatePicker.vue'))
Vue.component('textarea-component',require('./components/ComponentesForm/textArea.vue'))
Vue.component('table-componet',require('./components/ComponentesForm/tablaAgenda.vue'))
Vue.component('notificacion-component',require('./components/mensajesInbox/notificacionesAgenda.vue'))
Vue.component('editar-component',require('./components/ComponentesForm/DataEdit.vue'))
Vue.component('evento-component',require('./components/evento/eventos.vue'))
Vue.component('chat-component',require('./components/evento/chat.vue'))
const app = new Vue({

    el: '#main'
});


