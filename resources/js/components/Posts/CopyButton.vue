<template>
    <a @click.prevent="copy" :href="link" class="copy-link" v-b-tooltip.hover title="Copy post link">
        <i class="far fa-copy"></i>
        <b-alert
            v-model="showAlert"
            class="position-fixed fixed-bottom m-0 rounded-0"
            style="z-index: 2000;"
            variant="info"
            dismissible>Link to this post has been copied to the clipboard. You can send it to your friends.
        </b-alert>
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
                    this.showAlert = true
                    setTimeout(() => {
                        this.showAlert = false
                    }, 80000)
                })
            }
        }
    }
</script>
