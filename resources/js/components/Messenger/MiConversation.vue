<template>
    <div class="col-md-12 col-lg-8 message-wrapper justify-content-end" :class="{swipe:contact!==null}">
        <div class="swipe-back" @click="$emit('swipe')">
            <div class="title-dark"><i class="fa fa-chevron-left mr-2"></i>{{lang('messenger.back')}}
                <span v-if="contact!==null" class="date-info ml-2">{{contact.last_seen}}</span>
            </div>
        </div>
        <MessagesFeed v-if="contact" :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MiMessagesFeed'
    import MessageComposer from './MiMessageComposer'

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }

                this.axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            },
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>
