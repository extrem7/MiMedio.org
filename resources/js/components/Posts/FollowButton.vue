<template>
    <div class="item">
        <button @click.prevent="follow" class="button btn-transform b-sm"
                :class="{'btn-blue':!following,'cancel-btn':following}">
            {{following?'Unfollow':'Follow'}}
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            user_id: Number,
            initial_following: Boolean
        },
        data() {
            return {
                following: false
            }
        },
        methods: {
            async follow() {
                try {
                    const {data} = await this.axios.post(`/user/${this.user_id}/follow`)

                    this.$bus.emit('follow', {
                        user: this.user_id,
                        following: data.following,
                        followers: data.followers
                    })
                } catch (e) {
                }
            }
        },
        created() {
            this.following = this.initial_following
            this.$bus.on('follow', ({user, following}) => {
                if (this.user_id === user) {
                    this.following = following
                }
            })
        }
    }
</script>
