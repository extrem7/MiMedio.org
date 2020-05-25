import getters from './getters'
import actions from './actions'
import mutations from './mutations'

const state = {
    replyTo: null
}

export default {
    state,
    getters,
    actions,
    mutations,
    namespaced: true,
}
