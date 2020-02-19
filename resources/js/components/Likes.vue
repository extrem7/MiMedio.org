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
                    if (data.active) {
                        this.likes++
                        this.liked = true
                        if(this.disliked){
                            this.dislikes--
                            this.disliked = false
                        }
                    } else {
                        this.likes--
                        this.liked = false
                    }

                } catch (e) {

                }
            },
            async dislike() {
                try {
                    const {data} = await this.axios.post(`/post/${this.post_id}/dislike`)
                    if (data.active) {
                        this.dislikes++
                        this.disliked = true
                        if(this.liked){
                            this.likes--
                            this.liked = false
                        }
                    } else {
                        this.dislikes--
                        this.disliked = false
                    }

                } catch (e) {

                }
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
