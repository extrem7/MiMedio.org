import Vue from "vue"

import route from 'ziggy'
import {Ziggy} from 'ziggy'

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
        shared: (key) => shared()[key]
    }
})
