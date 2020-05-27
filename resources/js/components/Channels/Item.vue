<template>
    <div class="col-sm-10 col-md-6 col-xl-4 mb-3 channels-category">
        <div class="box-shadow-content channel-info-box">
            <div class="item justify-content-between category-name">
                <a :href="channel.link" class="title-dark title-nowrap">{{channel.name}}</a>
            </div>
            <div class="item">
                <follow-button :user_id="channel.id"
                               :initial_following="!!channel.is_following"
                               :initial_followers="channel.followers_count"
                               :disabled="disabled">
                </follow-button>
            </div>
        </div>
        <div class="box-rounded up-to-top border-top-0">
            <a :href="channel.link">
                <img :src="channel.logo" alt="channel.name">
            </a>
            <div class="category-info d-flex align-items-center justify-content-between mt-3">
                <div class="d-flex flex-wrap mr-3">
                    <a href="" class="inherit-color medium-bold">
                        <span class="blue-color semi-bold">{{channel.posts_count}}</span>
                        {{lang('channels.posts')}}
                    </a>
                    <a href="" class="inherit-color medium-bold">
                        <span class="blue-color semi-bold">{{channel.likes_count}}</span>
                        {{lang('channels.likes')}}
                    </a>
                    <a href="" class="inherit-color medium-bold">
                        <span class="blue-color semi-bold">{{channel.dislikes_count}}</span>
                        {{lang('channels.dislikes')}}
                    </a>
                    <a href="" class="inherit-color medium-bold">
                        <span class="blue-color semi-bold">{{channel.shares_count}}</span>
                        {{lang('channels.shares')}}
                    </a>
                </div>
                <copy-button :link="channel.link" subject="channel"></copy-button>
            </div>
        </div>
    </div>
</template>

<script>
    import FollowButton from "./FollowButton"
    import CopyButton from "~/components/Posts/CopyButton"

    export default {
        props: {
            channel: Object
        },
        data() {
            return {
                disabled: this.shared('user') !== null && this.channel.id === this.shared('user').id
            }
        },
        components: {
            FollowButton,
            CopyButton
        }
    }
</script>
