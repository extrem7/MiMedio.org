<template>
    <b-alert
        v-model="showAlert"
        class="position-fixed m-0 rounded-0 text-center"
        :class="`fixed-${position}`"
        style="z-index: 2000;"
        :variant="variant"
        dismissible>{{text}}
    </b-alert>
</template>

<script>

    export default {
        data() {
            return {
                showAlert: false,
                variant: null,
                text: null,
                position: null,
                delay: null,

                timeout: null,
            }
        },
        created() {
            this.$bus.on('alert', ({variant = 'primary', text, position = 'top', delay = 8}) => {
                clearTimeout(this.timeout)

                this.variant = variant
                this.text = text
                this.position = position

                this.showAlert = true
                this.timeout = setTimeout(() => {
                    this.showAlert = false
                }, delay * 1000)
            })
        }
    }
</script>
