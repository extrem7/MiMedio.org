<template>
    <section class="category-own-media mt-3 mt-md-5">
        <div class="d-flex slider-header justify-content-between align-items-center">
            <div class="title-semi-bold blue-color medium-size">{{name}} {{lang('channel.rss.title')}}</div>
            <div class="d-flex slide-panel">
                <button class="button btn-silver-light slide-prev"><i class="fas fa-chevron-left"></i>
                </button>
                <button class="button btn-silver-light slide-next ml-1"><i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="inline-block-pc">
            <post v-for="post in posts" :key="post.id" v-bind="post"></post>
            <infinite-loading
                v-if="posts.length"
                class="loading-horizontal"
                direction="right"
                @infinite="load">
                <div slot="no-more"></div>
                <div slot="no-results"></div>
            </infinite-loading>
        </div>
    </section>
</template>

<script>
    import redmedial from "~/services/redmedial"

    import Post from "./RssPost"
    import InfiniteLoading from "~/components/Includes/InfiniteLoadingExtra"

    export default {
        props: {
            name: String,
            rss: Number
        },
        data() {
            return {
                posts: [],

                page: 1,
                lastPage: 1,
            }
        },
        methods: {
            async load($state) {
                if (this.page < this.lastPage) {
                    this.page += 1
                    try {
                        const {posts} = await redmedial.rssFeed(this.rss, this.page)
                        this.posts = this.posts.concat(posts)
                        $state.loaded()
                    } catch (e) {
                        console.log(e)
                    }
                } else {
                    $state.complete()
                }
            },
        },
        async created() {
            const {posts, lastPage} = await redmedial.rssFeed(this.rss)
            this.posts = posts
            this.lastPage = lastPage
        },
        components: {
            Post,
            InfiniteLoading,
        },
    }
</script>

<style lang="scss" scoped>
    .infinite-status-prompt {
        display: block !important;
    }

    .infinite-loading-container.loading-horizontal {
        padding: 0 50px;
        display: flex;
        align-items: center;
    }
</style>
