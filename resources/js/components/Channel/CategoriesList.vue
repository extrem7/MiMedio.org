<template>
    <div>
        <section v-for="category in categories" class="category-own-media mt-3 mt-md-5">
            <div class="d-flex slider-header justify-content-between align-items-center">
                <div class="title-semi-bold blue-color medium-size">{{category.name}} {{lang('channel.categories.news')}}</div>
                <div class="d-flex slide-panel">
                    <button class="button btn-silver-light slide-prev"><i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="button btn-silver-light slide-next ml-1"><i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="inline-block-pc">
                <post v-for="post in category.posts" :key="post.id" :post="post" :show-views="false"></post>
                <div v-if="category.load_more" class="d-flex align-items-center ml-2">
                    <a :href="route('users.show.category',{
                           'user':user.id,
                           'category':category.slug
                           })" class="button btn-yellow btn-transform">{{lang('channel.categories.see_all')}}</a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Post from "~/components/Posts/PostSm"

    export default {
        data() {
            return {
                user: this.shared('channel') || null,
                categories: this.shared('categoriesWithPosts') || []
            }
        },
        components: {
            Post
        }
    }
</script>
