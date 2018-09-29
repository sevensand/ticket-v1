
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import { routes } from './components/routes/routes'
import App from './components/App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Toaster from 'v-toaster'

export const bus = new Vue();

Vue.use(Vuetify)
Vue.use(VueRouter )
Vue.use(VueAxios, axios);
Vue.use(Toaster, {timeout: 5000})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('login', require('./components/login/loginPage.vue'));
Vue.component('register', require('./components/register/registerPage.vue'));
// Vue.component('dashboard', require('./components/dashboard/dashBoard.vue'));



const router = new VueRouter({
  routes,
  mode: 'history'
});
Vue.router=router

Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
