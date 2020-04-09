<template>
    <a @click.prevent="copy" :href="link">Share in Message</a>
</template>

<script>
    import {copyTextToClipboard} from '../../helpers'

    export default {
        props: {
            link: String
        },
        data() {
            return {
                showAlert: false
            }
        },
        methods: {
            copy() {
                copyTextToClipboard(this.link, () => {
                    this.$bus.emit('copy-alert')
                })
            }
        }
    }
</script>
