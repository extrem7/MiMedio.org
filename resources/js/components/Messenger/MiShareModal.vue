<template>
    <b-modal id="mi-share" size="sm" centered dialog-class="modal-send-message" body-class="modal-send-message"
             header-class="d-none" footer-class="d-none">
        <button type="button" class="close" @click="$bvModal.hide('mi-share')">
            <img src="/assets/img/icons/close.svg" alt="close">
        </button>
        <div class="chat-list-sidebar">
            <div class="box-shadow-content text-center">
                <div class="title-semi-bold blue-color">Your contacts</div>
                <div class="small-size medium-bold silver-color">Select user to send link</div>
            </div>
            <div class="box-rounded border-top-0 vertical-scroll">
                <div v-for="contact in contacts" @click="select(contact.id)" class="chat-item"
                     :class="{active:selected===contact.id}">
                    <div class="avatar">
                        <img :src="contact.avatar" :alt="contact.name">
                    </div>
                    <div class="chat-info">
                        <div class="name"><span class="title-nowrap">{{contact.name}} </span><span
                            class="status" :class="[contact.is_online?'online':'offline']"></span></div>
                    </div>
                </div>

            </div>
            <div class="text-center">
                <button @click="send"
                        :disabled="selected===null"
                        :class="[selected===null?'btn-secondary':'btn-blue btn-transform']"
                        class="button w-75 semi-bold shadow-none mt-2 mb-2">
                    Send message
                </button>
            </div>
        </div>
    </b-modal>
</template>

<script>
    export default {
        data() {
            return {
                post_id: null,

                contacts: _.sortBy(this.shared('contacts'), [(contact) => {
                    return contact.last ? contact.last.id : false
                }]).reverse() || [],
                selected: null
            }
        },
        methods: {
            async send() {
                const {status} = await this.axios.post(this.route('messenger.share', this.selected), {
                    post_id: this.post_id
                })
                if (status === 201) {
                    this.selected = null
                    this.$bvModal.hide('mi-share')
                    this.$bus.emit('alert', {text: 'Message with link has been sent'})
                }
            },
            select(id) {
                if (this.selected === id) {
                    this.selected = null
                } else {
                    this.selected = id
                }
            }
        },
        created() {
            this.$bus.on('mi-share', post_id => {
                this.post_id = post_id
            })
        }
    }
</script>

<style lang="scss" scoped>
    .chat-item {
        cursor: pointer;

        &.active {
            cursor: not-allowed;
        }
    }
</style>

