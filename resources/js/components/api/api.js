import axios from 'axios';

export default {
    async getCourses(cb) {
        await axios
            .get('/admin/course/list')
            .then(response => cb(response.data.data))
    },
    async saveExam(exam, rute, cb) {
        await axios({
                method: 'post',
                url: rute,
                data: exam
            })
            .then(response => cb(response.data.data))

    }
}
