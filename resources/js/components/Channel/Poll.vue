<template>
    <div class="vote box-rounded mb-4" v-if="poll">
        <div class="title-semi-bold blue-color medium-size">{{lang('channel.poll.title')}}</div>
        <div class="title-dark semi-bold mt-2">{{poll.question}}</div>
        <div class="progress-bars">
            <div v-for="option in answers">
                <div class="answer">
                    <span class="blue-color">{{ option.percent||0 }}% - </span>
                    {{ option.name }}
                    {{option.voted?` (${lang('channel.poll.you_voted')})`:''}}
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" :style="{width:option.percent+'%'}"
                         :aria-valuenow="option.percent"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="vote-answer" v-if="shared('logged_in') && !voted">
            <div class="custom-control custom-radio" v-for="option in poll.options">
                <input type="radio" class="custom-control-input" :id="`option-${option.id}`"
                       name="options" v-model="value"
                       :value="option.id">
                <label class="custom-control-label blue-color"
                       :for="`option-${option.id}`">{{option.name}}</label>
            </div>
            <button class="button btn-yellow btn-transform mt-3" @click="vote">{{lang('channel.poll.vote')}}!
            </button>
        </div>
        <p class="mt-3" v-if="!shared('logged_in')">{{lang('channel.poll.please')}} <a :href="route('login')">{{lang('channel.poll.login')}}</a>
            {{lang('channel.poll.or')}} <a
                :href="route('register')">{{lang('channel.poll.register')}}</a> {{lang('channel.poll.to_vote')}}
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            const poll = this.shared('poll')

            return {
                poll,
                answers: this.shared('answers') || [],

                value: poll.options[0].id || null,
                voted: poll.voted || false
            }
        },
        methods: {
            async vote() {
                const {data} = await this.axios.post(this.route('poll.vote', this.poll.id), {
                    option: this.value
                })
                if (data.status === 'ok') {
                    this.voted = true
                    this.answers = data.answers
                }
            }
        }
    }
</script>
