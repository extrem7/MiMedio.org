<template>
    <div class="col-md-12 col-lg-4 message-list-wrapper">
        <ul class="contact-list">
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)"
                :class="{ active: contact == selected }">
                <div class="d-flex align-items-center">
                    <div class="avatar">
                        <img :src="contact.avatar" :alt="contact.name">
                    </div>
                    <div>
                        <div class="date-info" v-if="contact.last">{{contact.last.date_diff}}
                            <span class="ml-2 badge badge-danger" v-if="contact.unread">{{ contact.unread }}</span>
                        </div>
                        <div class="name text-nowrap mt-1">{{ contact.name }}</div>
                        <div class="message-short-text title-line-cap mt-2"
                             v-if="contact.last"
                             v-html="(contact.last.from==user.id?`${lang('messenger.you')}: `:'' ) + contact.last.text">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            },
            user: {
                type: Object
            }
        },
        data() {
            return {
                loaded: false,
                selected: null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;

                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                const contacts = _.sortBy(this.contacts, [(contact) => {
                    return contact.last ? contact.last.id : false
                }]).reverse()

                if (!this.loaded) {
                    if (shared().chat) {
                        this.selected = contacts.find((contact) => contact.id == shared().chat)
                    } else if (window.innerWidth > 991) {
                        this.selected = contacts[0]
                    }
                    this.$emit('selected', this.selected)
                    this.loaded = true
                }
                return contacts
            }
        }
    }
</script>
