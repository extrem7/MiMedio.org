import {CLEAR_REPLY_TO} from "./mutation-types"

export default {
    async store({commit, state}, {post_id, text}) {
        console.log(state)
        const {data, status} = await this.app.axios.post(this.app.route('comments.store', post_id), {
            text: text,
            reply: state.replyTo
        })
        if (status === 201) {
            commit(CLEAR_REPLY_TO)
            return data.comment
        } else {
            throw Error
        }
    },
}
