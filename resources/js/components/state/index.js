import Vuex from 'vuex'
import Vue from 'vue'
import api from '../api/api'

/**
 * Vuex for the state
 */
Vue.use(Vuex)

const actions = {
    async getCurses ({commit}) {
        await api.getCourses(courses => commit('setCourses', courses))
    },
    async loadExam ({commit}, rute ) {
        await api.loadExam(rute, exam => commit('setExam', exam))
    },
    async saveExam ({commit}, { rute, exam, isEdit }) {
        await api.saveExam(exam, rute, isEdit, exam => commit('setExam', exam))
    },
    async saveQuestion ({commit}, { rute, question, isEdit }) {
        const id = question.id
        await api.saveQuestion(question, rute, isEdit, question => commit('saveQuestion', { question, id }))
    },
    async loadQuestions ({commit}, exam ) {
        await api.loadQuestions(exam, questions => commit('setQuestions', questions))
    },
    async deleteQuestion ({commit}, question) {
        await api.deleteQuestion(question, () => commit('deleteQuestion', question))
    },
    async saveAnswer () {

    }
}

const mutations = {
    setExam (state, exam) {
        state.exam = exam
    },
    setCourses (state, courses) {
        state.courses = courses
    },
    setQuestions (state, questions) {
        state.questions = questions
    },
    newQuestion (state) {
        let id = ""
        let chars = "abcdefghijklmnopqrstuvwxyz"
        for( let i=0; i < 5; i++ ) {
            id += chars.charAt(Math.floor(Math.random() * chars.length))
        }
        state.questions.push({
            id,
            quiz: null,
            type: 'choice',
            exam_id: state.exam.id
        })
    },
    newAnswer (state) {
        let id = ""
        let chars = "abcdefghijklmnopqrstuvwxyz"
        for( let i=0; i < 5; i++ ) {
            id += chars.charAt(Math.floor(Math.random() * chars.length))
        }
        state.answers.push({
            id,
            option: null,
            exam_id: state.exam.id
        })
    },
    saveQuestion (state, { question, id }) {
        const removedId = state.questions.findIndex(item => item.id === id);
        state.questions.splice(removedId, 1, question);
    },
    deleteQuestion(state, question) {
        const removedId = state.questions.findIndex(item => item.id === question);
        state.questions.splice(removedId, 1)
    }
}

const getters = {
    getAllCourses: state => {
        return state.courses
    },
    getExam: state => {
        return state.exam
    }
}

const state = {
    exam: {
        name: null,
        description:null,
        course_id:null
    },
    courses: [],
    questions: [],
    answers: []

}

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})

export default store;
