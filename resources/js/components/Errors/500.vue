<template>
    <b-alert
        v-model="showAlert"
        class="position-fixed fixed-top m-0 rounded-0"
        style="z-index: 2000;"
        variant="danger"
        dismissible>Internal Server Error. The server encountered an internal error or misconfiguration and was unable
        to complete your request.
    </b-alert>
</template>

<script>
    export default {
        data() {
            return {
                showAlert: false
            }
        },
        created() {
            this.$bus.on('server-error', () => {
                this.showAlert = true
                setTimeout(() => {
                    this.showAlert = false
                }, 100000)
            })
        }
    }
</script>
