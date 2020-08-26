<template>
    <div class="article-collapse">
        <div class="box-shadow-content channel-box">
            <a :href="link" class="channel-img" target="_blank">
                <img :src="logo" :alt="`rss item - ${id}`">
            </a>
            <i v-if="draggable" class="far fa-hand-rock handle"></i>
        </div>

        <div class="collapse-item" v-for="post in posts">
            <div class="box-shadow-content">
                <div class="d-flex">
                    <div class="collapse-button collapsed" v-b-toggle="'article-'+post.id"></div>
                    <div class="collapse-wrapper">
                        <a :href="post.link" class="article-title title-line-cap" target="_blank">{{post.title}}</a>
                    </div>
                    <div class="title-dark extra-small-size date">{{post.date | moment("HH:mm")}}</div>
                </div>
            </div>
            <b-collapse :id="'article-'+post.id" :accordion="'accordion-'+id">
                <div class="box-rounded border-top-0">
                    <div class="box-date mb-2">{{post.date | moment("DD.MM.YYYY")}}</div>
                    <div class="article-short-text title-line-cap" v-html="post.excerpt"></div>
                </div>
            </b-collapse>
        </div>

        <button v-if="toggleable"
                @click="toggle"
                class="button btn-transform b-lg w-100 semi-bold shadow-none mt-2"
                :class="[saved?'btn-danger':'btn-blue']">
            {{lang(saved?'rss.remove':'rss.save')}}
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            id: Number,
            logo: String,
            link: String,
            posts: Array,
            saved: Boolean,
            toggleable: {
                type: Boolean,
                required: false
            },
            draggable: {
                type: Boolean,
                required: false
            }
        },
        methods: {
            async toggle() {
                try {
                    const {status} = await this.axios.post(this.route('rss.toggle', this.id))
                    if ([201, 204].includes(status)) {
                        const saved = status === 201
                        this.$emit('toggle', {id: this.id, saved})
                        if (saved) {
                            this.$bus.emit('alert', {
                                text: this.lang('rss.saved'),
                                variant: 'primary'
                            })
                        } else {
                            this.$bus.emit('alert', {
                                text: this.lang('rss.removed'),
                                variant: 'secondary'
                            })
                        }
                    }
                } catch ({response}) {
                    if (response.status === 409) {
                        this.$bus.emit('alert', {
                            text: this.lang('rss.no_more'),
                            variant: 'warning'
                        })
                    }
                }

            }
        }
    }
</script>

<style scoped>
    .handle {
        position: absolute;
        top: 20px;
        right: 21px;
        cursor: grab;
        font-size: 20px;
    }
</style>
