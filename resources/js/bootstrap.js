// Import dependencies.
import lodash from 'lodash';
import jQuery from 'jquery';
import Popper from 'popper.js';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Echo from "laravel-echo";

// Initialize dependencies.
window._ = lodash;
window.Popper = Popper.default;
window.$ = window.jQuery = jQuery;
window.Vue = Vue;
window.axios = axios;
window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0a6d2a3f39e16ed0eeafdd',
    cluster: 'ap2',
    encrypted: true
});

window.Echo.channel('streamer.197886470')
	.listen('.streamer.followed', function (e) {
	    console.log(e);
	})
	.listen('streamer.followed', function (e) {
	    console.log(e);
	});

require('bootstrap');

// Tell Vue to use VueRouter.
Vue.use(VueRouter);

Vue.prototype.$url = window.url;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}