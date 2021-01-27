import api from '../api/api'

const actions = {
    async startExam ({commit}, examID) {
        await api.startExam(examID, exam => commit('startExam', exam))
    }
}

const mutations = {
    startExam (stateStartExam, exam) {
        stateStartExam.exam = exam
    },
}

const  state = {
    exam: {}
}

const User = {
    namespaced: true,
    state,
    mutations,
    getters: {

    },
    actions
}

export default User
