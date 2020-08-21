<template>
    <div class="article-column-card rss-feed">
        <div class="left-column">
            <a :href="link" class="article-img" target="_blank">
                <img :src="thumbnail" :alt="title">
            </a>
        </div>
        <div class="right-column">
            <div class="d-flex align-items-start">
                <a :href="link" class="article-title title-line-cap mb-2" target="_blank">{{title}}</a>
            </div>
            <div class="date-info bottom-line d-flex align-items-center mb-2">
                {{date | moment("DD.MM.YYYY HH.mm")}}
            </div>
            <div class="article-short-text title-line-cap" v-html="excerpt"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id:Number,
            title: String,
            link: String,
            thumbnail: String,
            date: String,
            excerpt: String
        }
    }
</script>

