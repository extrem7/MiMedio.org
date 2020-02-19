<template>
    <li>
        <div class="d-flex comment-item">
            <img v-if="comment.author.avatar" :src="comment.author.avatar" alt="user" class="avatar">
            <div>
                <div class="d-flex align-items-start align-items-sm-center flex-column flex-sm-row">
                    <div class="name">{{comment.author.name}}</div>
                    <div class="date ml-0 ml-sm-2 mb-2 mb-sm-0">{{comment.date}}</div>
                </div>
                <div>{{comment.text}}</div>
                <div class="mt-2 d-flex align-items-center">
                    <button class="icon" :class="{active:liked}" @click.prevent="like">
                        <i class="far fa-thumbs-up text-success"></i> {{likes}}
                    </button>
                    <button class="icon ml-2" :class="{active:disliked}" @click.prevent="dislike">
                        <i class="far fa-thumbs-down text-danger"></i> {{dislikes}}
                    </button>
                    <button class="blue-color text-uppercase extra-small-size ml-2 icon" @click="reply">REPLY</button>
                </div>
            </div>
        </div>
        <transition-group appear name="comments-transition" tag="ul" class="comment-list"
                          v-if="comment.children.length">
            <item v-for="(comment,i) in comment.children" :comment="comment" :key="i"></item>
        </transition-group>
    </li>
</template>

<script>
    export default {
        props: {
            comment: Object
        },
        name: 'item',
        data() {
            return {
                likes: 0,
                liked: false,
                dislikes: 0,
                disliked: false
            }
        },
        methods: {
            reply() {
                this.$bus.emit('reply', this.comment.id)
            },
            async like() {
                try {
                    const {data} = await this.axios.post(`/comment/${this.comment.id}/like`)
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
                    const {data} = await this.axios.post(`/comment/${this.comment.id}/dislike`)
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
            this.likes = this.comment.initial_likes
            this.dislikes = this.comment.initial_dislikes
            switch (this.comment.current_like) {
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
