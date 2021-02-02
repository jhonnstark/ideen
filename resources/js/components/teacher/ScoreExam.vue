<template>
    <div class="container">

        <div class="row justify-content-center" v-if="score.exam">
            <div class="col-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5 class="card-text">{{ score.exam.name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Empezado a las: </strong>{{ score.created_at }}</p>
                        <p><strong>Puntos correctos: </strong>{{ score.mark }}</p>
                        <p><strong>Total de preguntas: </strong>{{ score.exam.questions.length }}</p>
                        <hr>
                        <grade-question
                            v-for="(question, index) in score.exam.questions"
                            :key="question.id"
                            :question="question"
                            :index="index"
                        >
                        </grade-question>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-else>
            <div class="col-md-12 text-center">
                <loader></loader>
            </div>
        </div>

    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('Teacher')

export default {
    name: "ScoreExam",
    props: ['id'],
    data() {
        return {
            isLoading: true,
        }
    },
    computed: {
        ...mapState({
            score: state => state.score,
        })
    },
    created() {
        this.loadScore(this.id)
            .then(() => this.isLoading = false)
            .catch(error => console.log(error))
    },
    methods: {
        ...mapActions([
            'loadScore',
        ]),
    }
}
</script>

<style scoped>

</style>
