<template>
    <draggable class="rss-categories" tag="ul" handle=".rss-drag">
        <li v-for="({id,name,active}) in feeds" :key="id">
            <div class="item">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="rss_feeds[]" class="custom-control-input"
                           v-model="active"
                           :id="`feed-item-${id}`"
                           :value="id">
                    <label class="custom-control-label" :for="`feed-item-${id}`"></label>
                </div>
            </div>
            <div class="item label">{{name}}</div>
            <span class="item rss-drag"><i class="far fa-hand-rock"></i></span>
        </li>

    </draggable>
</template>

<script>
    import Draggable from 'vuedraggable'

    export default {
        data() {
            return {
                feeds: this.shared('rssFeeds')
            }
        },
        components: {
            Draggable,
        }
    }
</script>
