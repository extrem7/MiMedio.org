<template>
    <a @click.prevent="copy" :href="link" class="copy-link" v-b-tooltip.hover :title="`Copy ${subject} link`">
        <i class="far fa-copy"></i>
    </a>
</template>

<script>
    import {copyTextToClipboard} from '~/helpers'

    export default {
        props: {
            link: String,
            subject: {
                type: String,
                default: 'post'
            }
        },
        data() {
            return {
                showAlert: false
            }
        },
        methods: {
            copy() {
                copyTextToClipboard(this.link, () => {
                    this.$bus.emit('alert', {text: `Link to this ${this.subject} has been copied to the clipboard.`})
                })
            }
        }
    }
</script>
