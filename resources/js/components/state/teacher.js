import api from '../api/api'

const actions = {
    async gradeExam ({commit}, examID) {
        await api.gradeExam(examID, exam => commit('gradeExam', exam))
    },
    async finishExam ({commit}, rute) {

    },
    async loadScore ({commit}, scoreID) {
        await api.loadScore(scoreID, score => commit('loadScore', score))
    },
}

const mutations = {
    gradeExam (state, exam) {
        state.exam = exam
    },
    loadScore (state, score) {
        state.score = score
    }
}


const  stated = {
    exam: {
        scores: {}
    },
    score: {}
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
