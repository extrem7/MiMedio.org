<template></template>

<script>
    import {createTextLinks} from '~/helpers'

    export default {
        mounted() {
            this.$echo.private(`messages.${this.shared('user').id}`)
                .listen('NewMessage', ({message}) => {
                    const sender = message.from_contact,
                        href = this.route('messenger', sender.id),
                        text = createTextLinks(message.text)

                    const title = this.$createElement('a', {attrs: {href}}, `${lang('messenger.new_message')} ${sender.name}`)

                    this.$bvToast.toast(this.$createElement('div', {domProps: {innerHTML: text}}), {
                        toaster: 'b-toaster-bottom-right',
                        href: href,
                        title: title,
                        autoHideDelay: 10000,
                        solid: true,
                        appendToast: true
                    })
                });
        }
    }
</script>

<style lang="scss">
    .toast-header a, a.toast-body {
        color: #626262;
    }
</style>
