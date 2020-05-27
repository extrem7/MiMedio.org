<template>
    <a @click.prevent="copy" :href="link" class="copy-link" v-b-tooltip.hover
       :title="`${lang('posts.copy.copy')} ${subject} ${lang('posts.copy.link')}`">
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
                    this.$bus.emit('alert', {text: `${this.lang('posts.copy.link_to')} ${this.subject} ${this.lang('posts.copy.copied')}`})
                })
            }
        }
    }
</script>
