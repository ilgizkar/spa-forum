require('./bootstrap');

window.Vue = require('vue');

import vuetify from './vuetify'
import AppHome from './components/AppHome.vue'
import router from './router/router'
// Vue.component('AppHome', require('./components/AppHome.vue'));
import Vue from 'vue'
import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'

Vue.component('vue-simplemde', VueSimplemde);

import md from 'marked'
window.md = md;

import User from './helpers/User'
window.User = User;

import Exception from './helpers/Exception'
window.Exception = Exception;

window.EventBus = new Vue();


const app = new Vue({
    vuetify,
    render: h => h(AppHome),
    el: '#app',
    router
});
