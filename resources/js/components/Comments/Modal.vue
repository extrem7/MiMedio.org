<template>
    <b-modal id="last-comments" @hide="hide" size="sm" centered footer-class="d-none">
        <template v-slot:modal-title>
            <div class="semi-bold blue-color">Last Comments</div>
        </template>
        <template v-slot:modal-header-close>
            <img src="/assets/img/icons/close.svg" alt="close">
        </template>
        <div class="last-comment-box">
            <div class="last-comment" v-if="comments.length">
                <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment>
            </div>
            <form class="submit-comment" @submit.prevent="send">
                <textarea v-model="text" rows="3" class="control-form" required></textarea>
                <button class="button btn-blue"><i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </b-modal>
</template>
<script>
    import Comment from './ItemMini'
    import {CLEAR_REPLY_TO} from "~/store/modules/comments/mutation-types"

    export default {
        data() {
            return {
                post_id: null,
                comments: [],
                text: '',
            }
        },
        methods: {
            async send() {
                const comment = await this.$store.dispatch('comments/store', {
                    post_id: this.post_id,
                    text: this.text,
                })
                this.text = ''
                if (this.comments.length >= 3)
                    this.comments.splice(-1, 1)
                this.comments.unshift(comment)
            },
            hide() {
                this.$store.commit(`comments/${CLEAR_REPLY_TO}`)
            }
        },
        created() {
            this.$bus.on('last-comments', ({post_id, comments}) => {
                this.post_id = post_id
                this.comments = comments
            })
        },
        components: {
            Comment
        }
    }
</script>
