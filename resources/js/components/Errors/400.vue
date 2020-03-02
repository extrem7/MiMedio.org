<template>
    <b-alert
        v-model="showAlert"
        class="position-fixed fixed-top m-0 rounded-0"
        style="z-index: 2000;"
        variant="danger"
        dismissible>Check your data again.
    </b-alert>
</template>

<script>
    export default {
        data() {
            return {
                showAlert: false,
            }
        },
        created() {
            this.$bus.on('bad-request', () => {
                this.showAlert = true
                setTimeout(() => {
                    this.showAlert = false
                }, 10000)
            })
        }
    }
</script>
