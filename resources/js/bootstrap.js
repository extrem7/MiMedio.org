window.shared = function shared(){
    return window[window.sharedDataNamespace]
}

window._ = require('lodash');
window.Popper = require('popper.js').default;

window.Vue = require('vue')

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import {BootstrapVue} from 'bootstrap-vue'

Vue.use(BootstrapVue)

import VueBus from 'vue-bus'

Vue.use(VueBus)

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});
