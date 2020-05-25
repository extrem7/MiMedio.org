<template>
    <div class="dropdown-menu dropdown-last-comment last-comment-box" @click.stop>
        <div class="semi-bold blue-color mb-2">Last Comments</div>
        <div class="last-comment">
            <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment>
        </div>
        <form class="submit-comment" @submit.prevent="send">
            <textarea v-model="text" rows="3" class="control-form" required></textarea>
            <button class="button btn-blue"><i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</template>

<script>
    import Comment from './ItemMini'

    export default {
        props: {
            post_id: Number,
            initialComments: Array
        },
        data() {
            return {
                comments: this.initialComments,
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
        },
        components: {
            Comment
        }
    }
</script>

<style scoped>

</style>
