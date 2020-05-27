<template>
    <a @click.prevent="send" href="#">{{lang('posts.share_messenger')}}</a>
</template>

<script>
    export default {
        props: {
            post_id: Number
        },
        methods: {
            send() {
                this.$bus.emit('mi-share', this.post_id)
                this.$bvModal.show('mi-share')
            }
        }
    }
</script>
