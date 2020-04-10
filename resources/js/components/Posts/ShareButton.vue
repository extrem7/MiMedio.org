<template>
    <a @click.prevent="share" href="#">Share in My Feed</a>
</template>

<script>
    import {copyTextToClipboard} from '../../helpers'

    export default {
        props: {
            postId: Number
        },
        methods: {
           async share() {
               try {
                   const {data} = await this.axios.post(`/post/${this.postId}/share`)
                   copyTextToClipboard(this.link, () => {
                       this.$bus.emit('share-alert')
                   })
               } catch (e) {

               }
            }
        }
    }
</script>
