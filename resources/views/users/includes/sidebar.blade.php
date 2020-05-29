<div class="col-lg-4 col-12">
    @include('posts.includes.playlist',['class'=>'mt-4 mt-lg-0'])
    <poll v-if="shared('poll')"></poll>
    <rss-item v-if="shared('savedRss')" v-bind="shared('savedRss')" class="mt-4 mb-4"></rss-item>
    <random-following-feed></random-following-feed>
</div>
