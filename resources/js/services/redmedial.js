import axios from 'axios'

const http = axios.create()
delete http.defaults.headers.common['X-Requested-With']
delete http.defaults.headers.common['X-CSRF-TOKEN']

export default {
    api: 'https://redmedial.com/wp-json/app/v1',
    async rssFeed(rss, page = 1, limit = 6) {
        const offset = (page - 1) * limit
        const {status, data} = await http.get(`${this.api}/posts`, {
            params: {
                rss,
                offset,
                limit
            }
        })
        if (status === 200) {
            const {posts, count} = data.data
            return {
                posts,
                lastPage: count / 6
            }
        }
        return []
    }
}
