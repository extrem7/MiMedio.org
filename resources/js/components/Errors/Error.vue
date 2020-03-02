<template>
    <div>
        <bad-request></bad-request>
        <unauthenticated></unauthenticated>
        <server-error></server-error>
    </div>
</template>

<script>
    import BadRequest from './400'
    import Unauthenticated from "./403"
    import ServerError from './500'

    export default {
        components: {
            BadRequest,
            Unauthenticated,
            ServerError
        }
    }
</script>
