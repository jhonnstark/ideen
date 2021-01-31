import api from '../api/api'

const actions = {
    async gradeExam ({commit}, examID) {
        await api.gradeExam(examID, exam => commit('gradeExam', exam))
    },
    async finishExam ({commit}, rute) {

    },
}

const mutations = {
    gradeExam (state, exam) {
        state.exam = exam
    },
}


const  stated = {
    exam: {
        scores: {}
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
