<template>
    <b-alert
        v-model="showAlert"
        class="position-fixed fixed-top m-0 rounded-0"
        style="z-index: 2000;"
        variant="primary"
        dismissible>Your are unauthenticated. Please <a :href="routes.login">login</a> or <a :href="routes.register">create
        an account</a> to
        continue.
    </b-alert>
</template>

<script>
    export default {
        data() {
            return {
                showAlert: false,
                routes: shared().routes
            }
        },
        created() {
            this.$bus.on('unauthenticated', () => {
                this.showAlert = true
                setTimeout(() => {
                    this.showAlert = false
                }, 15000)
            })
        }
    }
</script>
