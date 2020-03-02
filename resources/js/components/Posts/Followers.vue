<template>
    <div class="item">
        <span class="follow-icon"><i class="fas fa-user"></i></span>{{followers}}
    </div>
</template>

<script>
    export default {
        props: {
            user_id: Number,
            initial_followers: Number
        },
        data() {
            return {
                followers: 0
            }
        },
        created() {
            this.followers = this.initial_followers

            this.$bus.on('follow', ({user, followers}) => {
                if (this.user_id === user) {
                    this.followers = followers
                }
            })
        }
    }
</script>
