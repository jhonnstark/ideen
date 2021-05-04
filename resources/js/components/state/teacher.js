import api from '../api/api'
import Common from "../common";

const actions = {
    async loadHomework ({commit}, activityID) {
        await api.loadHomework(activityID, homework => commit('loadHomework', homework))
    },
    async loadStudents ({commit}, courseID) {
        await api.loadStudents(courseID, students => commit('loadStudents', students))
    },
    async gradeExam ({commit}, examID) {
        await api.gradeExam(examID, exam => commit('gradeExam', exam))
    },
    async loadScore ({commit}, scoreID) {
        await api.loadScore(scoreID, score => commit('loadScore', score))
    },
    async saveMark ({commit, state}, mark) {
        await api.saveMark(state.score.id, mark)
    },
    async addScore ({ commit }, claim) {
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
    },
    async saveResult ({commit}, result) {
        await api.saveResult(result)
    }
}

const mutations = {
    loadStudents (state, students) {
        state.students = students
    },
    loadHomework (state, homework) {
        state.homework = homework
    },
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
    },
    setActivities (state, activities) {
        state.activities = activities
    },
    setGrades (state, grades) {
        state.grades = grades
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
    },
    homework: [],
    activities: [],
    grades: [],
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
