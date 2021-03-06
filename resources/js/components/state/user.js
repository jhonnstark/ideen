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
    },
    async finishExam ({commit, state}, rute) {
        await api.finishExam(rute, state.claims)
    }
}

const mutations = {
    startExam (state, exam) {
        state.exam = exam
    },
    saveClaim (state, claim) {
        const removedId = state.claims.findIndex(item => item.id === claim.id);
        if (removedId >= 0) {
            state.claims.splice(removedId, 1, claim)
        } else {
            state.claims.push(claim)
        }
    },
    loadClaim (state, claim) {
        if (!Array.isArray(claim)) {
            state.claims.push(claim)
        }
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
