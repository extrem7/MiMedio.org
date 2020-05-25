import Vue from 'vue'

import VueEcho from 'vue-echo';

import Pusher from 'pusher-js'

window.Pusher = Pusher

Vue.use(VueEcho, {
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
})
