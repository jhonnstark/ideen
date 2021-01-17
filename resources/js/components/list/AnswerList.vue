<template>
    <div v-if="question" class="row justify-content-center air-around">
        <div class="col-md-8 offset-md-2">
            <h5>Respuestas</h5>
            <answer-form v-for="(answer, index) in answersQuestion" :answer="answer" :key="index"></answer-form>
            <button
                @click="newAnswer(question)"
                class="btn btn-sm btn-primary" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2a.75.75 0 01.75.75v4.5h4.5a.75.75 0 010 1.5h-4.5v4.5a.75.75 0 01-1.5 0v-4.5h-4.5a.75.75 0 010-1.5h4.5v-4.5A.75.75 0 018 2z"></path></svg>
                Nueva respuesta</button>
        </div>
    </div>
</template>

<script>
import AnswerForm from "../form/AnswerForm";
import {mapMutations, mapState} from "vuex";

export default {
    props: ['question'],
    name: "AnswerList",
    components: {
        AnswerForm
    },
    methods: {
        ...mapMutations([
            'newAnswer',
        ]),
    },
    computed: {
        ...mapState([
            'answers',
        ]),
        answersQuestion () {
            console.log('answersQuestion', this.answers[this.question])
            return this.answers[this.question]
        }
    },
}
</script>

<style scoped>

</style>
