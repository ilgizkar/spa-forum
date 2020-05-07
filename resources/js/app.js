require('./bootstrap');

window.Vue = require('vue');

import vuetify from './vuetify'
import AppHome from './components/AppHome.vue'
import router from './router/router'
// Vue.component('AppHome', require('./components/AppHome.vue'));

const app = new Vue({
    vuetify,
    render: h => h(AppHome),
    el: '#app',
    router
});
