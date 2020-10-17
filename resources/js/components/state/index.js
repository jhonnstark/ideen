import Vuex from 'vuex'
import Vue from 'vue'
import api from '../api/api'

/**
 * Vuex for the state
 */
Vue.use(Vuex)

const actions = {
    async getCurses ({commit}) {
        await api.getCourses(courses => {
            commit('setCourses', courses)
        })
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
