import axios from 'axios';

export default {
    async getCourses(role, cb) {
        await axios
            .get('/' + role + '/course/list')
            .then(response => cb(response.data.data))
    },
    async getModules(role, course, cb) {
        await axios
            .get(`/${role}/course/edit/${course}/module`)
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
    async loadQuestions(rute, exam, cb) {
        await axios
            .get(`/${role}/question/${exam}/list`)
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
    async loadAnswers(question, cb) {
        if (Number.isInteger(question)) {
            await axios
                .get('/admin/answer/' + question + '/list')
                .then(response => cb(response.data.data))
        }
    },
    async deleteAnswer(question, cb) {
        if (Number.isInteger(question)) {
            await axios
                .delete('/admin/answer/delete/' + question)
        }
        cb()
    },
    async startExam(exam, cb) {
        await axios
            .get(exam +'/start/')
            .then(response => cb(response.data.data))
    },
    async loadClaim(question, cb) {
        await axios
            .get(question +'/claim/')
            .then(response => cb(response.data.data))
    },
    async saveClaim({ claim, question }, cb) {
        await axios
            .post(question +'/claim/', { claim })
            .then(response => cb(response.data.data))
    },
    async finishExam(rute, claims) {
        await axios
            .post(rute, { claims })
    },
    async gradeExam(exam, cb) {
        await axios
            .get(exam + '/grade/')
            .then(response => cb(response.data.data))
    },
    async loadScore(score, cb) {
        await axios
            .get(score +'/json/')
            .then(response => cb(response.data.data))
    },
    async saveMark(score, mark) {
        await axios
            .post(score +'/finish/', { mark })
    }
}
