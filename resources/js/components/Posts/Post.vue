<template>
    <post-content :post="post" class="article-card card-lg"></post-content>
</template>

<script>
    import PostContent from "./PostContent"

    export default {
        props: ['post'],
        components: {
            PostContent
        }
    }
</script>
