<template>
    <div class="d-inline-flex">
        <button class="button btn-silver-light" :class="{active:liked}" @click.prevent="like">
            <i class="far fa-thumbs-up"></i>
            <span class="badge-counter">{{likes}}</span>
        </button>
        <button class="button btn-silver-light" :class="{active:disliked}" @click.prevent="dislike">
            <i class="far fa-thumbs-down"></i>
            <span class="badge-counter">{{dislikes}}</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            post_id: Number,
            initial_likes: Number,
            initial_dislikes: Number,
            current_like: String
        },
        data() {
            return {
                likes: 0,
                liked: false,
                dislikes: 0,
                disliked: false
            }
        },
        methods: {
            async like() {
                try {
                    const {data} = await this.axios.post(`/post/${this.post_id}/like`)
                    this.setLikes(data)
                    if (data.active) {
                        this.liked = true
                        this.disliked = false
                    } else {
                        this.liked = false
                    }

                } catch (e) {

                }
            },
            async dislike() {
                try {
                    const {data} = await this.axios.post(`/post/${this.post_id}/dislike`)
                    this.setLikes(data)
                    if (data.active) {
                        this.disliked = true
                        this.liked = false
                    } else {
                        this.disliked = false
                    }

                } catch (e) {

                }
            },
            setLikes({likes, dislikes}) {
                this.likes = likes
                this.dislikes = dislikes
            }
        },
        created() {
            this.likes = this.initial_likes
            this.dislikes = this.initial_dislikes
            switch (this.current_like) {
                case 'like':
                    this.liked = true
                    break
                case 'dislike':
                    this.disliked = true
                    break
            }
        }
    }
</script>
