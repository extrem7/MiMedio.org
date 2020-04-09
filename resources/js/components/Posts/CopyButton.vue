<template>
    <a @click.prevent="copy" :href="link" class="copy-link" v-b-tooltip.hover title="Copy post link">
        <i class="far fa-copy"></i>
    </a>
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
