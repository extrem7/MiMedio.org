<template>
    <draggable class="rss-categories" tag="ul" handle=".rss-drag">
        <li v-for="({name},slug) in feeds" :key="slug">
            <div class="item">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="rss_feeds[]" class="custom-control-input"
                           v-model="feeds[slug].active"
                           :id="`feed-item-${slug}`"
                           :value="slug">
                    <label class="custom-control-label" :for="`feed-item-${slug}`"></label>
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
