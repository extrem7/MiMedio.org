export default {
    methods: {
        openCommentsModal() {
            this.$bus.emit('last-comments', {
                post_id: this.post.id,
                comments: this.post.comments
            })
            this.$bvModal.show('last-comments')
        }
    }
}
