<template>
    <a @click.prevent="share" href="#">{{lang('posts.share_feed')}}</a>
</template>

<script>
    import {copyTextToClipboard} from '~/helpers'

    export default {
        props: {
            postId: Number
        },
        methods: {
            async share() {
                try {
                    await this.axios.post(`/post/${this.postId}/share`)
                    copyTextToClipboard(this.link, () => {
                        this.$bus.emit('alert', {text: this.lang('posts.shared')})
                    })
                } catch (e) {

                }
            }
        }
    }
</script>
