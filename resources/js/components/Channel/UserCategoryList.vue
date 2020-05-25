<template>
    <div class="col-12 col-lg-8">
        <div class="row inline-blocks">
            <post v-for="post in posts" class="col-md-6" :post="post" :key="post.id"></post>
            <infinite-loading
                :class="[direction==='right'?'loading-horizontal':'']"
                :direction="direction"
                @infinite="load">
                <div slot="no-more"></div>
                <div slot="no-results"></div>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
    import Post from "../Posts/PostContent"
    import InfiniteLoading from "~/components/Includes/InfiniteLoadingExtra"

    export default {
        data() {
            const posts = this.shared('posts')
            return {
                posts: posts.data || [],
                page: 1,
                lastPage: posts.last_page || 1,
                direction: window.innerWidth > 992 ? 'bottom' : 'right'
            }
        },
        methods: {
            async load($state) {
                if (this.page < this.lastPage) {
                    this.page += 1
                    try {
                        const response = await this.axios.get('', {
                            params: {
                                page: this.page
                            }
                        })
                        this.posts = this.posts.concat(response.data.data)
                        $state.loaded()
                    } catch (e) {

                    }
                } else {
                    $state.complete()
                }
            },
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

    .infinite-loading-container {
        display: flex;

        &:not(.loading-horizontal) {
            width: 100%;
            justify-content: center;
        }

        &.loading-horizontal {
            padding: 0 50px;
            display: flex;
            align-items: center;
        }
    }
</style>
