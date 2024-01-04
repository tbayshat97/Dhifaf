import axios from "axios";
import Vue from "vue";
import Vuex from "vuex";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common[
    "Accept-Language"
] = document.head.querySelector('meta[name="base-lang"]').content;
let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.baseURL = document.head.querySelector(
    'meta[name="api-base-url"]'
).content;
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

window.Vuex = Vuex;
window.Vue = Vue;
Vue.use(Vuex);
