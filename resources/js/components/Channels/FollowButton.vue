<template>
    <button @click.prevent="follow" class="btn b-sm" :class="{'btn-blue':!following,'btn-yellow':following}">
        <span class="small-size semi-bold mr-2">{{followers}}
            <i class="fas fa-user"></i>
        </span> {{lang('channels.followers')}}
    </button>
</template>

<script>
    import follow from '../../mixins/follow'

    export default {
        mixins: [follow],
        props: {
            initial_followers: String
        },
        data() {
            return {
                followers: 0
            }
        },
        created() {
            this.followers = this.initial_followers

            this.$bus.on('follow', ({user, following, followers}) => {
                if (this.user_id === user) {
                    this.followers = followers
                }
            })
        }
    }
</script>
