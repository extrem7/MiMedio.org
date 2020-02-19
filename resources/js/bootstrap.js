window.shared = function shared(){
    return window[window.sharedDataNamespace]
}

window.Vue = require('vue')

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import VueBus from 'vue-bus'
Vue.use(VueBus)
