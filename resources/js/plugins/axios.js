import Vue from 'vue'

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
}

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    console.log(error)
    const status = error.response.status

    if (status === 401) {
        Vue.bus.emit('alert', {text: 'Your are not unauthenticated.', variant: 'danger'})
    } else if (status === 403) {
        Vue.bus.emit('alert', {text: 'Your haven\'t permission to do it.', variant: 'danger'})
    } else if (status === 422) {
        Vue.bus.emit('alert', {text: 'Validation error. Please check your input data.', variant: 'warning'})
    } else if ((status % 500) < 100) {
        Vue.bus.emit('alert', {
            text: 'Internal Server Error. The server encountered an internal error or misconfiguration and was unable to complete your request.',
            variant: 'danger',
            position: 'top',
            delay: 12
        })
    }

    throw error
})
