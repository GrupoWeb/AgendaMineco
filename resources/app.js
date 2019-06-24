require('./bootstrap');
//var EventBus =new Vue;
import Vue from 'vue'
import Axios from 'axios'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import Lang from 'element-ui/lib/locale/lang/es';
import Locale from 'element-ui/lib/locale';
Locale.use(Lang);
Vue.use(ElementUI, {size: 'small'})
Vue.prototype.$eventHub = new Vue()
Vue.prototype.$http = Axios;

Vue.component('index-evento', require('./components/Eventos/Index.vue').default);
Vue.component('x-form-group', require('./components/form/src/FormGroup.vue').default);
const app = new Vue({
    el: '#app'
});
