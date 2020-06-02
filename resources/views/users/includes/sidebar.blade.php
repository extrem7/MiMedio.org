<div class="col-lg-4 col-12">
    @include('posts.includes.playlist',['class'=>'mt-4 mt-lg-0'])
    <poll v-if="shared('poll')"></poll>
    <rss-item v-if="shared('rss_to_show')" v-bind="shared('rss_to_show')" class="mt-4 mb-4"></rss-item>
    <following-to-show></following-to-show>
</div>
