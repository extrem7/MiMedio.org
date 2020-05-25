<template>
    <div class="message-list" v-if="contact" ref="feed">
        <div class="date-info last-seen">{{contact.last_seen}}</div>
        <div class="message-li" v-for="(message,i) in messages">
            <div class="box-shadow-content date" v-if="newDay(message,i-1)">{{message.day}}</div>
            <div class="message-item user-message"
                 :class="`${message.to == contact.id ? 'my' : 'user'}-message`" :key="message.id">
                <div class="d-flex align-items-center">
                    <div v-if="message.to != contact.id" class="avatar">
                        <img :src="contact.avatar" :alt="contact.name">
                    </div>
                    <div>
                        <div v-if="message.to != contact.id" class="name text-nowrap mb-2">{{ contact.name }}</div>
                        <div class="message-full-text" v-html="parseLinks(message.text)"></div>
                    </div>
                </div>
                <div class="text-right silver-color">{{message.date}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import {createTextLinks} from '~/helpers'

    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            newDay(curr, prev) {
                if (prev == -1) return true
                return curr.day !== this.messages[prev].day
            },
            parseLinks(text) {
                return createTextLinks(text)
            },
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>
