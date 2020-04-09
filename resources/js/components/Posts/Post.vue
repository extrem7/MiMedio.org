<template>
    <div class="article-card card-lg">
        <a :href="post.link" class="article-img mb-3 lg-img">
            <img :src="post.thumbnail" alt="name-article">
        </a>
        <a :href="post.link" class="article-title title-nowrap mb-2">{{post.title}}</a>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="date-info bottom-line d-flex align-items-center">
                {{post.date_dots}} <a :href="post.author.link"
                                      class="profile-link title-nowrap">{{post.author.name}}</a>
            </div>
            <copy-button :link="post.link"></copy-button>
        </div>
        <div class="article-short-text title-line-cap">{{post.excerpt}}</div>
        <div class="article-button-action mt-3 position-relative">
            <div class="d-inline-flex">
                <likes :post_id="post.id"
                       :initial_likes="post.likes_count"
                       :initial_dislikes="post.dislikes_count"
                       :current_like="post.current_like">
                </likes>

                <button class="button btn-silver-light dropdown-toggle btn-comment"
                        :data-toggle="post.has_comments?'dropdown':''">
                    <i class="far fa-comment-alt"></i><span class="badge-counter" v-if="post.has_comments">{{post.comments_count}}
                </span>
                </button>

                <a :href="`${post.link}/#comments`" class="button btn-silver-light dropdown-toggle btn-comment-link">
                    <i class="far fa-comment-alt"></i>
                    <span class="badge-counter" v-if="post.has_comments">>{{post.comments_count}}</span>
                </a>
                <div class="dropdown-menu dropdown-last-comment" v-if="post.has_comments">
                    <div class="semi-bold blue-color mb-2">Last Comments</div>
                    <div class="last-comment">
                        <div class="last-comment-item" v-for="comment in post.comments.slice(0,3)">
                            <div class="d-flex align-items-center">
                                <div class="name title-nowrap">{{comment.author.name}}</div>
                                <div class="date">{{comment.date}}</div>
                            </div>
                            <div class="text-comment mt-1 title-line-cap">{{comment.text}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-muted ml-15 mr-2">Share:</div>
                <div class="btn-group">
                    <button class="button btn-silver-light extra-bold dropdown-toggle"
                            data-toggle="dropdown">Mi
                    </button>
                    <div class="dropdown-menu dropdown-light">
                        <a href="" class="">Share in My Feed</a>
                        <send-button :link="post.link"></send-button>
                    </div>
                    <div v-html="post.share_links"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Likes from "./Likes"
    import CopyButton from "./CopyButton"
    import SendButton from "./SendButton"

    export default {
        name: "Post",
        props: ['post'],
        components: {
            Likes,
            CopyButton,
            SendButton
        }
    }
</script>
