<template>
    <div class="col-md-6 vertical-scroll inline-blocks">
        <div v-for="post in posts" class="article-mini-card" :key="post.id">
            <div class="left-column">
                <a :href="post.link" class="article-img">
                    <img
                        :src="post.thumbnail"
                        alt="name-article">
                </a>
                <div class="divider"></div>
            </div>
            <div class="right-column">
                <div class="box-date">{{post.date_dots}}</div>
                <a :href="post.link" class="article-title title-line-cap">{{post.title}}</a>
            </div>
        </div>
        <infinite-loading @infinite="load">
            <div slot="no-more"></div>
            <div slot="no-results"></div>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading'

    export default {
        props: {
            user_id: Number,
            initial_posts: Object
        },
        components: {
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
                        const response = await this.axios.get(`/channel/${this.user_id}/posts/${this.page}`)
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
