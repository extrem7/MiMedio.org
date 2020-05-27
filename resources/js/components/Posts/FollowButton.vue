<template>
    <div class="item">
        <button @click.prevent="follow" class="button btn-transform b-sm"
                :class="{'btn-blue':!following,'btn-darkC':following}">
            {{lang(following?'posts.unfollow':'posts.follow')}}
        </button>
    </div>
</template>

<script>
    import follow from '../../mixins/follow'

    export default {
        mixins: [follow]
    }
</script>
