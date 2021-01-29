import api from '../api/api'

const actions = {
    async startExam ({commit}, examID) {
        await api.startExam(examID, exam => commit('startExam', exam))
    },
    async loadClaim ({commit}, question){
        await api.loadClaim(question, claim => commit('loadClaim', claim))
    },
    async saveClaim ({commit}, answer) {
        await api.saveClaim(answer, claims => commit('saveClaim', claims))
    }
}

const mutations = {
    startExam (state, exam) {
        state.exam = exam
    },
    saveClaim (state, claim) {
        state.claims.push(claim)
    },
    loadClaim (state, claim) {
        state.claims.push(claim)
    }
}

const  stated = {
    exam: {
        teacher: {}
    },
    claims: []
}

const getters = {

}

const User = {
    namespaced: true,
    state: stated,
    mutations,
    getters,
    actions
}

export default User
