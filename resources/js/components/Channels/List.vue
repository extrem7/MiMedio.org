<template>
    <div class="row">
        <channel v-for="channel in channels" :key="channel.id" :channel="channel"></channel>
        <infinite-loading @infinite="load">
            <div slot="no-more"></div>
            <div slot="no-results"></div>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading'
    import Channel from './Item'

    export default {
        data() {
            const channels = this.shared('channels')
            return {
                channels: channels.data || [],
                page: 1,
                lastPage: channels.last_page || 1,
            }
        },
        methods: {
            async load($state) {
                if (this.page < this.lastPage) {
                    this.page += 1
                    try {
                        const response = await this.axios.get('', {
                            params: {
                                page: this.page
                            }
                        })
                        this.channels = this.channels.concat(response.data.data)
                        $state.loaded()
                    } catch (e) {

                    }
                } else {
                    $state.complete()
                }
            },
        },
        components: {
            Channel,
            InfiniteLoading
        }
    }
</script>

<style lang="scss" scoped>
    .infinite-loading-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }
</style>
