<template>
    <div class="item">
        <button @click.prevent="follow" class="button btn-transform b-sm"
                :class="{'btn-blue':!following,'cancel-btn':following}">
            {{following?'Unfollow':'Follow'}}
        </button>
    </div>
</template>

<script>
    import follow from '../../mixins/follow'

    export default {
        mixins: [follow]
    }
</script>
