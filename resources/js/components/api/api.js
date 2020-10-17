import axios from 'axios';

export default {
    async getCourses(cb) {
        await axios
            .get('/admin/course/list')
            .then(response => cb(response.data.data))
    },
}
