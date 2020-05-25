import Vue from 'vue'

import './axios'
import './mixins'
import './broadcasting'

import {BootstrapVue} from 'bootstrap-vue'

Vue.use(BootstrapVue)

import VueBus from 'vue-bus'

Vue.use(VueBus)

import VueMoment from 'vue-moment'

Vue.use(VueMoment)
