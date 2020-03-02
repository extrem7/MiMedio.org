import axios from "axios"

require('./bootstrap')

import store from './store'

import Error from "./components/Errors/Error"
import PostsVerticalList from "./components/Posts/VerticalList"
import Likes from "./components/Posts/Likes"
import Comments from './components/Comments/List'
import CopyButton from "./components/Posts/CopyButton"
import FollowButton from "./components/Posts/FollowButton"
import Followers from "./components/Posts/Followers"

const app = new Vue({
    el: '#app',
    components: {
        Error,
        PostsVerticalList,
        Likes,
        Comments,
        CopyButton,
        Followers,
        FollowButton
    },
    store,
})

store.app = app

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    console.log(error)
    if (error.response.status == 401) {
        app.$bus.emit('unauthenticated')
    }
    else if (error.response.status == 400) {
        app.$bus.emit('bad-request')
    } else{
        app.$bus.emit('server-error')
    }

    throw new Error('Invalid token detected')
})
