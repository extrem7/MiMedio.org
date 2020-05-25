import {CLEAR_REPLY_TO, SET_REPLY_TO} from "~/store/modules/comments/mutation-types"

export default {
    props: {
        comment: Object
    },
    data() {
        return {
            likes: 0,
            liked: false,
            dislikes: 0,
            disliked: false
        }
    },
    computed: {
        isReplyTo() {
            return this.$store.state.comments.replyTo === this.comment.id
        }
    },
    methods: {
        reply() {
            if (this.isReplyTo) {
                this.$store.commit(`comments/${CLEAR_REPLY_TO}`)
            } else {
                this.$store.commit(`comments/${SET_REPLY_TO}`, this.comment.id)
            }
        },
        async like() {
            try {
                const {data} = await this.axios.post(`/comment/${this.comment.id}/like`)
                if (data.active) {
                    this.likes++
                    this.liked = true
                    if (this.disliked) {
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
                    if (this.liked) {
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
