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
    async saveQuestion(question, rute, isEdit, cb) {
        await axios({
            method: isEdit ? 'put' : 'post',
            url: rute,
            data: question
        })
            .then(response => cb(response.data.data))
    },
    async loadQuestions(exam, cb) {
        await axios
            .get('/admin/question/' + exam + '/list')
            .then(response => cb(response.data.data))
    },
    async deleteQuestion(question, cb) {
        if (Number.isInteger(question)) {
            await axios
                .delete('/admin/question/delete/' + question)
        }
        cb()
    },
    async saveAnswer(answer, rute, isEdit, cb) {
        await axios({
            method: isEdit ? 'put' : 'post',
            url: rute,
            data: answer
        })
            .then(response => cb(response.data.data))
    },
    async deleteAnswer(question, cb) {
        if (Number.isInteger(question)) {
            await axios
                .delete('/admin/answer/delete/' + question)
        }
        cb()
    },
}
