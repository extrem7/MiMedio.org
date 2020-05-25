window._ = require('lodash')

import Vue from 'vue'

import './plugins'

import store from './store'

import components from './components'

const app = new Vue({
    el: '#app',
    components,
    store
})

store.app = app
