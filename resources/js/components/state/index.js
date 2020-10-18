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
    async saveExam ({commit}, { rute, exam }) {
        await api.saveExam(exam, rute, exam => commit('setExam', exam))
    },
}

const mutations = {
    setExam (state, exam) {
        state.exam = exam
    },
    setCourses (state, courses) {
        state.courses = courses
    },
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
        exam: [],
        courses: []
    },
    getters,
    mutations,
    actions
};

const store = new Vuex.Store(options)

export default store;
