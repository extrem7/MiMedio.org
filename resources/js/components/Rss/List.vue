<template>
    <draggable class="row article-collapse-list inline-blocks" v-model="items" handle=".handle" @sort="move">
        <div v-for="item in items" :key="item.id" class="col-md-6 col-lg-4 collapse-card">
            <item v-bind="item" draggable toggleable @toggle="toggle"></item>
        </div>
    </draggable>
</template>

<script>
    import Draggable from 'vuedraggable'
    import Item from "./Item"

    export default {
        data() {
            return {
                items: Object.values(this.shared('rssItems')) || [],
            }
        },
        methods: {
            move() {
                const order = this.items.map(item => item.id)
                this.axios.post(this.route('rss.sort'), {order})
            },
            toggle({id, saved}) {
                this.items.find(item => item.id === id).saved = saved
            }
        },
        components: {
            Draggable,
            Item,
        }
    }
</script>
