import Vue from 'vue'
import {} from "./mutation-types"

function catchErrors(response, store) {
    if (response.status === 422) {
        const message = Object.values(response.data.errors).reduce((acc, cur) => {
            return acc + cur + '\r\n'
        }, '')
        store.app.$bvToast.toast(message, {
            toaster: 'b-toaster-bottom-right',
            variant: 'warning',
            title: store.app.lang('vue.order.errors.validation'),
            autoHideDelay: 15000,
            appendToast: true
        })
    } else {
        const message = store.app.lang('vue.order.errors.server')
        store.app.$bvToast.toast(message, {
            toaster: 'b-toaster-bottom-right',
            variant: 'danger',
            title: 'Увага',
            autoHideDelay: 7000,
            appendToast: true
        })
    }
    throw Error
}

export default {
    async preview({commit, getters}) {
        try {
            const response = await Vue.axios.post(shared().routes.preview, getters.preparedData)
            if (response.data.pdf)
                commit(UPDATE_PDF, response.data.pdf)
        } catch ({response}) {
            try {
                catchErrors(response, this)
            } catch (e) {
                throw Error
            }
        }
    },
}
