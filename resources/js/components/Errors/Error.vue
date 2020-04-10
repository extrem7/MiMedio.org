<template>
    <div>
        <bad-request></bad-request>
        <unauthenticated></unauthenticated>
        <server-error></server-error>
        <b-alert
            v-model="copy"
            class="position-fixed fixed-bottom m-0 rounded-0"
            style="z-index: 2000;"
            variant="info"
            dismissible>Link to this post has been copied to the clipboard. You can send it to your friends in <a
            href="/messenger">our messenger</a>.
        </b-alert>
        <b-alert
            v-model="share"
            class="position-fixed fixed-bottom m-0 rounded-0"
            style="z-index: 2000;"
            variant="info"
            dismissible>This post has been shared to your channel.
        </b-alert>
    </div>
</template>

<script>
    import BadRequest from './400'
    import Unauthenticated from "./403"
    import ServerError from './500'

    export default {
        components: {
            BadRequest,
            Unauthenticated,
            ServerError
        },
        data() {
            return {
                copy: false,
                share: false,
            }
        },
        created() {
            this.$bus.on('copy-alert', () => {
                this.copy = true
                setTimeout(() => {
                    this.copy = false
                }, 8000)
            })
            this.$bus.on('share-alert', () => {
                this.share = true
                setTimeout(() => {
                    this.share = false
                }, 8000)
            })
        }
    }
</script>
