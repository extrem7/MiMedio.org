<template>
    <a @click.prevent="send" href="#">Share in Message</a>
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
