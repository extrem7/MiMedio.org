require('./bootstrap')

Vue.component('likes', require('./components/Likes.vue').default);

const app = new Vue({
    el: '#app',
});
