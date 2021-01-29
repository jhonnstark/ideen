import Vuex from 'vuex'
import Vue from 'vue'
import api from '../api/api'
import Common from "../common";
import User from "./user";

/**
 * Vuex for the state
 */
Vue.use(Vuex)

const actions = {
    async getCurses ({commit}) {
        await api.getCourses(courses => commit('setCourses', courses))
    },
    async loadExam ({commit}, rute ) {
        await api.loadExam(rute, exam => commit('setExam', exam))
    },
    async saveExam ({commit}, { rute, exam, isEdit }) {
        await api.saveExam(exam, rute, isEdit, exam => commit('setExam', exam))
    },
    async saveQuestion ({commit}, { rute, question, isEdit }) {
        const id = question.id
        await api.saveQuestion(question, rute, isEdit, question => commit('saveQuestion', { question, id }))
    },
    async loadQuestions ({commit}, exam ) {
        await api.loadQuestions(exam, questions => commit('setQuestions', questions))
    },
    async deleteQuestion ({commit}, question) {
        await api.deleteQuestion(question, () => commit('deleteQuestion', question))
    },
    async saveAnswer ({commit}, { rute, answer, isEdit }) {
        const id = answer.id
        await api.saveAnswer(answer, rute, isEdit, answer => commit('saveAnswer', { answer, id }))
    },
    async loadAnswers ({commit}, question ) {
        await api.loadAnswers(question, answers => commit('setAnswers', { answers, question }))
    },
    async deleteAnswer ({commit}, answer) {
        await api.deleteAnswer(answer.id, () => commit('deleteAnswer', answer))
    }
}

const mutations = {
    setExam (state, exam) {
        state.exam = exam
    },
    setCourses (state, courses) {
        state.courses = courses
    },
    setQuestions (state, questions) {
        state.questions = questions
        state.questions.forEach(question => state.answers[question.id] = [])
    },
    setAnswers (state, { answers, question }) {
        state.answers = { ...state.answers, [question] : answers }
    },
    newQuestion (state) {
        let id = Common.makeID()
        state.questions.push({
            id,
            quiz: null,
            type: 'choice',
            exam_id: state.exam.id
        })
    },
    newAnswer (state, question) {
        let id = Common.makeID()
        state.answers[question].push({
            id,
            option: null,
            question_id: question
        })
    },
    saveQuestion (state, { question, id }) {
        const removedId = state.questions.findIndex(item => item.id === id);
        state.questions.splice(removedId, 1, question);
        state.answers = { ...state.answers, [question.id] : [] }
    },
    saveAnswer (state, { answer, id }) {
        const removedId = state.answers[answer.question_id].findIndex(item => item.id === id);
        state.answers[answer.question_id].splice(removedId, 1, answer);
    },
    deleteQuestion(state, question) {
        const removedId = state.questions.findIndex(item => item.id === question);
        state.questions.splice(removedId, 1)
    },
    deleteAnswer(state, answer) {
        const removedId = state.answers[answer.question_id].findIndex(item => item.id === answer.id);
        state.answers[answer.question_id].splice(removedId, 1)
    }
}

const getters = {
    getAllCourses: state => {
        return state.courses
    },
    getExam: state => {
        return state.exam
    }
}

const stated = {
    exam: {
        name: null,
        description:null,
        course_id:null
    },
    courses: [],
    questions: [],
    answers: {}

}

const store = new Vuex.Store({
    modules: {
        User
    },
    state: stated,
    getters,
    mutations,
    actions
})

export default store;
