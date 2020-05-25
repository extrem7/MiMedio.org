<template>
    <li>
        <div class="d-flex comment-item" :class="{'comment-reply-to':isReplyTo}">
            <a :href="comment.author.link">
                <img v-if="comment.author.avatar" :src="comment.author.avatar" alt="user" class="avatar">
            </a>
            <div>
                <div class="d-flex align-items-start align-items-sm-center flex-column flex-sm-row">
                    <a :href="comment.author.link" class="name">{{comment.author.name}}</a>
                    <div class="date ml-0 ml-sm-2 mb-2 mb-sm-0">{{comment.date}}</div>
                </div>
                <div>{{comment.text}}</div>
                <div class="mt-2 d-flex align-items-center">
                    <button class="icon" :class="{active:liked}" @click.prevent="like">
                        <i class="fa-thumbs-up text-success" :class="{fas:liked,far:!liked}"></i> {{likes}}
                    </button>
                    <button class="icon ml-2" :class="{active:disliked}" @click.prevent="dislike">
                        <i class="fa-thumbs-down text-danger" :class="{fas:disliked,far:!dislikes}"></i> {{dislikes}}
                    </button>
                    <button class="blue-color text-uppercase extra-small-size ml-2 icon" @click="reply">
                        {{isReplyTo?'CANCEL REPLY':'REPLY'}}
                    </button>
                </div>
            </div>
        </div>
        <transition-group appear name="comments-transition" tag="ul" class="comment-list"
                          v-if="comment.children !==undefined && comment.children.length">
            <comment v-for="(comment,i) in comment.children" :comment="comment" :key="comment.id"></comment>
        </transition-group>
    </li>
</template>

<script>
    import comment from "./mixins/comment"

    export default {
        name: 'comment',
        mixins: [comment]
    }
</script>
