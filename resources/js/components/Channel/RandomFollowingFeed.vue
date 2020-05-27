<template>
    <div class="article-collapse mt-4">
        <div class="box-shadow-content channel-box">
            <a :href="user.link" class="channel-img">
                <img :src="user.logo" :alt="user.name">
            </a>
        </div>

        <div class="collapse-item" v-for="post in user.posts">
            <div class="box-shadow-content">
                <div class="d-flex">
                    <div class="collapse-button collapsed" v-b-toggle="'article-'+post.id"></div>
                    <div class="collapse-wrapper">
                        <a :href="post.link" class="article-title title-line-cap">{{post.title}}</a>
                    </div>
                    <div class="title-dark extra-small-size date">{{post.date | moment("HH:mm")}}</div>
                </div>
            </div>
            <b-collapse :id="'article-'+post.id" :accordion="'accordion-'+user.id">
                <div class="box-rounded border-top-0">
                    <div class="box-date mb-2">{{post.date | moment("DD.MM.YYYY")}}</div>
                    <div class="article-short-text title-line-cap" v-html="post.excerpt"></div>
                </div>
            </b-collapse>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: this.shared('randomFollowing') || null
            }
        }
    }
</script>
