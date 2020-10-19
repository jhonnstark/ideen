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
        await api.saveQuestion(question, rute, isEdit, question => commit('setQuestion', { question, id }))
    },
}

const mutations = {
    setExam (state, exam) {
        state.exam = exam
    },
    setCourses (state, courses) {
        state.courses = courses
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
    setQuestion (state, { question, id }) {
        console.log(id)
        const removedId = state.questions.findIndex(item => item.id === id);
        console.log(removedId)
        state.questions.splice(removedId, 1, question);
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

const options = {
    state: {
        exam: {
            name: null,
            description:null,
            course_id:null
        },
        courses: [],
        questions: []
    },
    getters,
    mutations,
    actions
};

const store = new Vuex.Store(options)

export default store;
