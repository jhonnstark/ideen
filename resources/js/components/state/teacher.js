import api from '../api/api'

const actions = {
    async startExam ({commit}, examID) {
        await api.startExam(examID, exam => commit('startExam', exam))
    },
}

const mutations = {
    startExam (state, exam) {
        state.exam = exam
    },
}


const  stated = {
    exam: {
        calification: {}
    },
}

const getters = {

}

const Teacher = {
    namespaced: true,
    state: stated,
    mutations,
    getters,
    actions
}

export default Teacher
