import api from '../api/api'
import Common from "../common";

const actions = {
    async gradeExam ({commit}, examID) {
        await api.gradeExam(examID, exam => commit('gradeExam', exam))
    },
    async finishExam ({commit}, rute) {

    },
    async loadScore ({commit}, scoreID) {
        await api.loadScore(scoreID, score => commit('loadScore', score))
    },
    async addScore ({ commit, store }, claim) {
        commit('cleanClaims', claim.id)
        commit('addScore', claim)
    },
    async holdScore ({commit}, claim) {
        commit('cleanClaims', claim.id)
        commit('holdScore', claim)
    },
    async removeScore ({commit}, claim) {
        commit('cleanClaims', claim.id)
        commit('removeScore', claim)
    }
}

const mutations = {
    gradeExam (state, exam) {
        state.exam = exam
    },
    loadScore (state, score) {
        state.score = score
    },
    addScore (state, claim) {
        state.claims.correct.push(claim.id)
    },
    holdScore (state, claim) {
        state.claims.inactive.push(claim.id)
    },
    removeScore (state, claim) {
        state.claims.incorrect.push(claim.id)
    },
    cleanClaims (state, id) {
        const results = Common.processClaims(id, state.claims)
        Object.keys(results).map((result) => {
            if (results[result] >= 0) {
                state.claims[result].splice(results[result], 1)
            }
        })
    }
}


const  stated = {
    exam: {
        scores: {}
    },
    score: {},
    claims: {
        correct: [],
        inactive: [],
        incorrect: []
    }
}

const getters = {
    getScore: state => {
        return state.score
    }
}

const Teacher = {
    namespaced: true,
    state: stated,
    mutations,
    getters,
    actions
}

export default Teacher
