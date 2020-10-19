import axios from 'axios';

export default {
    async getCourses(cb) {
        await axios
            .get('/admin/course/list')
            .then(response => cb(response.data.data))
    },
    async saveExam(exam, rute, isEdit, cb) {
        await axios({
                method: isEdit ? 'put' : 'post',
                url: rute,
                data: exam
            })
            .then(response => cb(response.data.data))

    },
    async loadExam(rute, cb) {
        await axios
            .get(rute)
            .then(response => cb(response.data.data))
    },
}
