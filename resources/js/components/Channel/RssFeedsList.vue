<template>
    <div class="rss-feeds-list">
        <rss-feed v-for="({name,rss},slug) in rssFeeds" :key="slug" :name="name" :rss="rss"></rss-feed>
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
