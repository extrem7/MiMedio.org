<template>
    <div class="last-comment-item">
        <div class="d-flex align-items-center">
            <div class="name title-nowrap">{{comment.author.name}}</div>
            <div class="date">{{comment.date}}</div>
        </div>
        <div class="text-comment mt-1 title-line-cap">{{comment.text}}</div>
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
</template>

<script>
    import comment from "./mixins/comment"

    export default {
        mixins: [comment]
    }
</script>

<style scoped>

</style>
