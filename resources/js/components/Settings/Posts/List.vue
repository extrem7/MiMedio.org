<template>
    <div class="row">
        <post v-for="(post,i) in posts" :key="post.id" :post="post" :edit="true" :show-author="false"
              :show-views="false" class="col-xl-4 col-md-6 vertical-column-mob" @deleted="deletePost(i)"></post>
        <div class="col-12">
            <infinite-loading @infinite="load">
                <div slot="no-more"></div>
                <div slot="no-results"></div>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
    import Post from "~/components/Posts/PostSm"
    import InfiniteLoading from 'vue-infinite-loading'

    export default {
        data() {
            const posts = this.shared('posts')
            return {
                posts: posts.data || [],
                page: 1,
                lastPage: posts.last_page || 1,
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
            deletePost(i) {
                this.posts.splice(i, 1)
            }
        },
        components: {
            Post,
            InfiniteLoading
        }
    }
</script>

