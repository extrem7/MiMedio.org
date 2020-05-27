<template>
    <div class="article-column-card">
        <div class="left-column">
            <a :href="post.link" class="article-img">
                <img :src="post.thumbnail" alt="name-article">
            </a>
            <div class="article-button-action">
                <div class="d-inline-flex">
                    <a @click.prevent="openCommentsModal"
                       class="button btn-silver-light dropdown-toggle btn-comment-link">
                        <i class="far fa-comment-alt"></i>
                        <span class="badge-counter">{{post.comments_count}}</span>
                    </a>
                    <div class="d-flex align-items-center">
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
        </div>
        <div class="right-column">
            <div class="d-flex align-items-start">
                <a :href="post.link" class="article-title title-line-cap mb-2">{{post.title}}</a>
                <div v-if="edit" class="d-flex flex-column align-items-center ml-2">
                    <a :href="route('posts.edit',post.id)" class="icon blue-color edit-post-btn">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button @click="destroy" class="icon blue-color edit-post-btn"><i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="date-info bottom-line d-flex align-items-center mb-2">
                {{post.date_dots}}
                <a v-if="showAuthor" :href="post.author.link" class="profile-link title-nowrap">{{post.author.name}}</a>
                <div v-if="showViews" :class="{'ml-2':showAuthor}" class="item"><i class="far fa-eye mr-1"></i>{{post.views}}</div>
            </div>
            <div class="article-short-text title-line-cap" v-html="post.excerpt"></div>
        </div>
    </div>
</template>

<script>
    import ShareButton from "./ShareButton"
    import SendButton from "./SendButton"
    import commentInModal from "~/mixins/commentInModal"

    export default {
        props: {
            post: Object,
            showAuthor: {
                type: Boolean,
                default: true
            },
            showViews: {
                type: Boolean,
                default: true
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            async destroy() {
                if (!confirm(this.lang('posts.sure'))) return
                const { status} = await this.axios.delete(this.route('posts.destroy', this.post.id))
                if (status === 200) {
                    this.$emit('deleted')
                    this.$bus.emit('alert', {text: this.lang('posts.deleted')})
                }
            }
        },
        mixins: [commentInModal],
        components: {
            ShareButton,
            SendButton
        }
    }
</script>
