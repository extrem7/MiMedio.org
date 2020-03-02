import Vue from 'vue'
import * as types from './mutation-types'

export default {
    [types.SET_REPLY_TO](state, id) {
        state.replyTo = id
    },
    [types.CLEAR_REPLY_TO](state) {
        state.replyTo = null
    }
}
