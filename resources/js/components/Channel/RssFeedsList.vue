<template>
    <div class="rss-feeds-list">
        <rss-feed v-for="({name,id}) in rssFeeds" :key="id" :name="name" :category_id="id"></rss-feed>
    </div>
</template>

<script>
    import RssFeed from "./RssFeed"

    export default {
        data() {
            return {
                rssFeeds: this.shared('rssFeeds')
            }
        },
        components: {
            RssFeed
        }
    }
</script>
