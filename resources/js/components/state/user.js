import api from '../api/api'

const actions = {
    async startExam ({commit}, examID) {
        await api.startExam(examID, exam => commit('startExam', exam))
    },
    async saveClaim ({commit}, answer) {
        await api.saveClaim(answer, claim => commit('saveClaim', claim))
    }
}

const mutations = {
    startExam (stateOld, exam) {
        stateOld.exam = exam
    },
    saveClaim(stateOld, claim) {
        stateOld.claim = claim
    }
}

const  state = {
    exam: {
        teacher: {}
    }
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
