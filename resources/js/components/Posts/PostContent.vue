<template>
    <div class="">
        <a :href="post.link" class="article-img mb-3 lg-img">
            <img :src="post.thumbnail" alt="name-article">
        </a>
        <a :href="post.link" class="article-title title-nowrap mb-2">{{post.title}}</a>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="date-info bottom-line d-flex align-items-center">
                {{post.date_dots}} <a :href="post.author.link"
                                      class="profile-link title-nowrap">{{post.author.name}}</a>
                <div class="item ml-2"><i class="far fa-eye mr-1"></i>{{post.views}}</div>
            </div>
            <copy-button :link="post.link"></copy-button>
        </div>
        <div class="article-short-text title-line-cap" v-html="post.excerpt"></div>
        <div class="article-button-action mt-3 position-relative">
            <div class="d-inline-flex">
                <likes :post_id="post.id"
                       :initial_likes="post.likes_count"
                       :initial_dislikes="post.dislikes_count"
                       :current_like="post.current_like">
                </likes>
                <button class="button btn-silver-light dropdown-toggle btn-comment"
                        :data-toggle="commentsCount?'dropdown':''">
                    <i class="far fa-comment-alt"></i><span class="badge-counter" v-if="commentsCount">{{commentsCount}}
                </span>
                </button>
                <a @click.prevent="openCommentsModal" class="button btn-silver-light dropdown-toggle btn-comment-link">
                    <i class="far fa-comment-alt"></i>
                    <span class="badge-counter" v-if="commentsCount">{{commentsCount}}</span>
                </a>
                <list-mini v-if="commentsCount" :post_id="post.id" :initial-comments="post.comments"></list-mini>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-muted ml-15 mr-2">Share:</div>
                <div class="btn-group">
                    <button class="button btn-silver-light extra-bold dropdown-toggle"
                            data-toggle="dropdown">Mi
                    </button>
                    <div class="dropdown-menu dropdown-light">
                        <share-button :post-id="post.id"></share-button>
                        <send-button :post_id="post.id"></send-button>
                    </div>
                    <div v-html="post.share_links"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ListMini from "~/components/Comments/ListMini"
    import Likes from "./Likes"
    import CopyButton from "./CopyButton"
    import ShareButton from "./ShareButton"
    import SendButton from "./SendButton"

    export default {
        props: ['post'],
        data() {
            return {
                commentsCount: this.post.comments_count
            }
        },
        components: {
            ListMini,
            Likes,
            CopyButton,
            ShareButton,
            SendButton
        }
    }
</script>
