<template>
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-4 article-card card-lg" v-for="post in posts" :key="post.id">
            <div class="box-shadow-content channel-info-box">
                <div class="item">
                    <a :href="post.author.link" class="profile-box">
                        <img :src="post.author.avatar" alt="name-article">
                        <div class="name title-nowrap">{{post.author.name}}</div>
                    </a>
                </div>
                <followers :user_id="post.author.id"
                           :initial_followers="post.author.followers.length"></followers>
                <follow-button
                    v-if="shared('user').id!==post.author.id"
                    :user_id="post.author.id" :initial_following="!!post.author.is_following">
                </follow-button>
            </div>
            <post-content class="box-rounded up-to-top border-top-0" :post="post"></post-content>
        </div>
        <infinite-loading @infinite="load">
            <div slot="no-more"></div>
            <div slot="no-results"></div>
        </infinite-loading>
    </div>
</template>

<script>
    import Followers from "./Followers"
    import FollowButton from "./FollowButton"
    import PostContent from "./PostContent"
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
        },
        components: {
            Followers,
            FollowButton,
            PostContent,
            InfiniteLoading
        }
    }
</script>

<style lang="scss" scoped>
    .infinite-loading-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }
</style>
