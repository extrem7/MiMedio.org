require('./bootstrap')

Vue.component('likes', require('./components/Likes.vue').default);
Vue.component('comments', require('./components/Comments/List.vue').default);

const app = new Vue({
    el: '#app',
});
