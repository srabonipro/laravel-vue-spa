require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex'
import routes from './router/index';
import { HasError, AlertError } from 'vform'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'
import CxltToastr from 'cxlt-vue2-toastr'

Vue.use(Vuex)

var toastrConfigs = {
    position: 'top right',
    showDuration: 1000,
    timeOut: 5000,
    closeButton: true,
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut',
}
Vue.use(CxltToastr, toastrConfigs)

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('app-header', require('./components/Header.vue').default);

const app = new Vue({
    el: '#app',
    router: routes,
});
