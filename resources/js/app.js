import axios from "axios"

require('./bootstrap')

import store from './store'

import Error from "./components/Errors/Error"
import PostsVerticalList from "./components/Posts/VerticalList"
import PostsHomeList from "./components/Posts/HomeList"
import Likes from "./components/Posts/Likes"
import Comments from './components/Comments/List'
import CopyButton from "./components/Posts/CopyButton"
import SendButton from "./components/Posts/SendButton"
import ShareButton from "./components/Posts/ShareButton"
import FollowButton from "./components/Posts/FollowButton"
import UserFollowButton from './components/Users/FollowButton'
import Followers from "./components/Posts/Followers"
import ColorPicker from "./components/ColorPicker"
import ChatApp from './components/Messenger/ChatApp'
import MiChat from "./components/Messenger/MiChat"

const app = new Vue({
    el: '#app',
    components: {
        Error,
        PostsVerticalList,
        PostsHomeList,
        Likes,
        Comments,
        CopyButton,
        SendButton,
        ShareButton,
        Followers,
        FollowButton,
        UserFollowButton,
        ColorPicker,
        ChatApp,
        MiChat
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
    } else if (error.response.status == 400) {
        app.$bus.emit('bad-request')
    } else {
        app.$bus.emit('server-error')
    }

    throw new Error('Invalid token detected')
})
