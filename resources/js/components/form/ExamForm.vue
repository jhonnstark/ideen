<template>

    <div class="container">
        <div class="row justify-content-center">
            <exam-add></exam-add>
        </div>


        <div v-if="exam" class="row justify-content-center">
            <h5>Preguntas</h5>
            <hr class="col-12">
            <question-form></question-form>
        </div>
    </div>

</template>

<script>
import { mapState } from 'vuex'
import ExamAdd from "../layouts/ExamAdd";
import QuestionForm from "./QuestionForm";

export default {
    name: "ExamForm",
    props: ['course', 'edit'],
    components: {
        ExamAdd,
        QuestionForm
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
            },
            rute: window.location.pathname
        }
    },
    computed: {

        ...mapState([
            'exam'
        ])

    }
}
</script>

<style scoped>

</style>
