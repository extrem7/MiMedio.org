import axios from 'axios'

const http = axios.create()
delete http.defaults.headers.common['X-Requested-With']
delete http.defaults.headers.common['X-CSRF-TOKEN']

export default {
    api: shared().feeds_api + '/categories',
    async feed(category_id, page = 1, limit = 6) {
        const offset = (page - 1) * limit
        const {status, data} = await http.get(`${this.api}/${category_id}`, {
            params: {
                offset,
                limit
            }
        })
        if (status === 200) {
            const {data: posts, count} = data
            return {
                posts: posts,
                lastPage: count / 6
            }
        }
        return []
    }
}
