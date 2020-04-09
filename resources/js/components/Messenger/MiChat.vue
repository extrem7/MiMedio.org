<template>
    <div class="row messenger w-100">
        <ContactsList v-if="contacts.length" :contacts="contacts" :user="user" @selected="startConversationWith"/>
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
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
            Echo.private(`messages.${this.user.id}`)
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
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message)
                this.contacts.find((contact) => {
                    return [message.to, message.from].includes(contact.id)
                }).last = message
            },
            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
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
            }
        },
        created() {
            this.contacts = this.initial_contacts
        }
    }
</script>
