/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import App from './App.vue';
import axios from 'axios'
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router'

import router from './routes/index'
import store from './store/store'

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)

Vue.use(VueAxios, axios);
axios.defaults.baseURL = process.env.MIX_BASE_URL;

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App),
});
