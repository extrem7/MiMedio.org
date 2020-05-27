<template>
    <div class="row messenger w-100">
        <ContactsList v-if="contacts.length" :contacts="contacts" :user="user" @selected="startConversationWith"/>
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" @swipe="swipe"/>
    </div>
</template>

<script>
    import Conversation from './MiConversation'
    import ContactsList from './MiContacts'

    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            initial_contacts: {}
        },
        components: {
            ContactsList,
            Conversation
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            this.$echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });

            /*this.axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });*/
        },
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                this.axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data
                        this.selectedContact = contact
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message)
                let sender = this.contacts.find((contact) => {
                    return [message.to, message.from].includes(contact.id)
                })
                sender.last = message
            },
            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                console.log(this.contacts.findIndex(({id}) => message.from === id))
                if (this.contacts.findIndex(({id}) => message.from === id)) {
                    console.log('new contact')
                    const sender = message.from_contact
                    sender.last = message
                    this.contacts.push(sender)
                }

                this.updateUnreadCount(message.from_contact, false)
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            },
            swipe() {
                this.selectedContact = null
            }
        },
        created() {
            this.contacts = this.initial_contacts
        }
    }
</script>
