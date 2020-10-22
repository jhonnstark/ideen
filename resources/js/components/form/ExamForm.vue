<template>

    <div class="container">
        <div class="row justify-content-center">
            <exam-add :edit="edit"></exam-add>
            <hr class="col-12">
        </div>


        <div v-if="exam.id" class="row justify-content-center">
            <div class="col-12 spacer">
                <h4>Preguntas</h4>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Formulario de creación de examenes</div>
                    <div class="card-body">
                        <question-form v-for="(question, index) in questions" :question="question" :key="index"></question-form>
                        <button
                            @click="newQuestion"
                            class="btn btn-primary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2a.75.75 0 01.75.75v4.5h4.5a.75.75 0 010 1.5h-4.5v4.5a.75.75 0 01-1.5 0v-4.5h-4.5a.75.75 0 010-1.5h4.5v-4.5A.75.75 0 018 2z"></path></svg>
                            Nueva pregrunta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapMutations, mapState} from 'vuex'
import ExamAdd from "../layouts/ExamAdd";
import QuestionForm from "./QuestionForm";

export default {
    name: "ExamForm",
    props: ['course', 'edit'],
    data() {
        return {
          //  rute: window.location.pathname + '/json'
        }
    },
    components: {
        ExamAdd,
        QuestionForm
    },
    created() {
        // if(this.edit) {
        //    console.log(this.exam)
        // }
    },
    methods: {
        ...mapMutations([
            'newQuestion',
        ]),
    },
    computed: {
        ...mapState([
            'exam',
            'questions'
        ])
    }
}
</script>

<style scoped>

</style>
