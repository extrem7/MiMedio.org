<template>
    <section v-if="sharedPosts.length" class="category-own-media mt-3 mt-md-5">
        <div class="d-flex slider-header justify-content-between align-items-center">
            <div class="title-semi-bold blue-color medium-size">{{lang('channel.shared')}}</div>
            <div class="d-flex slide-panel">
                <button class="button btn-silver-light slide-prev"><i class="fas fa-chevron-left"></i>
                </button>
                <button class="button btn-silver-light slide-next ml-1"><i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="inline-block-pc">
            <post v-for="post in sharedPosts" :key="post.id" :post="post" :show-views="false"></post>
        </div>
    </section>
</template>

<script>
    import Post from "~/components/Posts/PostSm"

    export default {
        data() {
            return {
                sharedPosts: this.shared('sharedPosts') || []
            }
        },
        components: {
            Post
        }
    }
</script>
