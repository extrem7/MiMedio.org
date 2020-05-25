<template>
    <div class="comment">
        <div class="box-shadow-content">
            <div class="title-dark semi-bold">{{title}}</div>
        </div>
        <div class="box-rounded up-to-top border-top-0" :class="{'pt-0':this.comments.length}">
            <transition-group appear name="comments-transition" tag="ul" class="comment-list" v-if="comments.length">
                <comment v-for="(comment,i) in comments" :comment="comment" :key="comment.id"></comment>
            </transition-group>
            <form @submit.prevent="send" class="submit-comment">
                <textarea v-model="text" rows="3" class="control-form" required></textarea>
                <button class="button btn-blue"><i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>
</template>

<script>
    import Comment from "./Item"

    export default {
        props: {
            post_id: Number,
            initial_count: Number
        },
        data() {
            return {
                comments: [],
                commentsCount: null,
                text: '',
            }
        },
        computed: {
            title() {
                if (this.commentsCount) {
                    const count = this.commentsCount
                    return count > 1 ? `${count} comments` : `1 comment`
                }
                return 'There are no comments yet'
            }
        },
        methods: {
            async send() {
                const comment = await this.$store.dispatch('comments/store', {
                    post_id: this.post_id,
                    text: this.text,
                })
                this.text = ''

                this.commentsCount++
                const {parent_id} = comment
                comment.children = []
                if (parent_id) {
                    let parent = null

                    function findParent(comment) {
                        console.log(comment.id, parent_id, comment.id == parent_id)
                        if (comment.id == parent_id) {
                            parent = comment
                        } else {
                            comment.children.forEach(findParent)
                        }
                    }

                    this.comments.forEach(findParent)
                    parent.children.push(comment)
                } else {
                    this.comments.push(comment)
                }
            },
        },
        async created() {
            try {
                const {data} = await this.axios.get(`/post/${this.post_id}/comments`)
                if (typeof data.comments == 'object') {
                    this.comments = Object.values(data.comments)
                } else {
                    this.comments = data.comments
                }
                this.commentsCount = data.count
            } catch (e) {

            }
        },
        components: {
            Comment
        }
    }
</script>

<style>
    .comments-transition-enter-active, .list-leave-active {
        transition: all 1s;
    }

    .comments-transition-enter, .comments-transition-leave-to {
        opacity: 0;
        transform: translateX(-60px);
    }
</style>
