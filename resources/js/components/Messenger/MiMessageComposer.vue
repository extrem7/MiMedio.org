<template>
    <div class="submit-message d-flex align-items-center">
        <textarea v-model="message" @keydown.enter="send" placeholder="Message..." class="control-form"></textarea>
        <button @click.prevent="send" class="btn-transform btn-blue button mx-164 ml-2">Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();

                if (this.message == '') {
                    return;
                }

                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>
