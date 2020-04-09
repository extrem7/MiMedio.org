<template>
    <div class="main-h-news inline-blocks vertical-scroll pr-1">
        <post v-for="post in posts" :post="post" :key="post.id"></post>
        <infinite-loading @infinite="load">
            <div slot="no-more"></div>
            <div slot="no-results"></div>
        </infinite-loading>
    </div>
</template>

<script>
    import Post from "./Post"
    import InfiniteLoading from 'vue-infinite-loading'

    export default {
        props: {
            user_id: Number,
            initial_posts: Object
        },
        components: {
            Post,
            InfiniteLoading,
        },
        data() {
            return {
                posts: [],
                page: 1,
                lastPage: 1
            }
        },
        methods: {
            async load($state) {
                if (this.page < this.lastPage) {
                    this.page += 1
                    try {
                        const response = await this.axios.get(`/home/posts/${this.page}`)
                        this.posts = this.posts.concat(response.data.data)
                        $state.loaded()
                    } catch (e) {

                    }
                } else {
                    $state.complete()
                }
            },
        },
        created() {
            this.posts = this.initial_posts.data
            this.lastPage = this.initial_posts.last_page
        }
    }
</script>
