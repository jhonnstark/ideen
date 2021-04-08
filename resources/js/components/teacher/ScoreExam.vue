<template>
    <div class="container">

        <div class="row justify-content-center" v-if="score.exam">
            <div class="col-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h5 class="card-text">{{ score.exam.name }}</h5>
                    </div>
                    <div class="card-body">
                        <p>Empezado a las: {{ score.created_at }}</p>
                        <p>Total de preguntas: {{ score.exam.questions.length }}</p>
                        <p class="points"><strong>Puntos: </strong>{{ mark + '%' }}</p>
                        <button
                            @click="finishExam(mark)"
                            type="button"
                            :class="[ isLoading? 'btn-secondary' : 'btn-primary']"
                            class="btn">
                            <svg
                                v-if="isLoading"
                                class="spin btn-loading"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                            Guardar
                        </button>
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
        mark() {
            let calification = this.claims.correct.length - this.claims.incorrect.length
            return calification <= 0 ? 0 : calification / (this.claims.correct.length + this.claims.inactive.length) * 100
        },
        ...mapState({
            score: state => state.score,
            claims: state => state.claims,
        }),
    },
    created() {
        this.loadScore(this.id)
            .then(() => this.isLoading = false)
            .catch(error => console.log(error))
    },
    methods: {

        ...mapActions([
            'loadScore',
            'saveMark',
        ]),

        finishExam(mark) {
            this.isLoading = true
            this.saveMark(mark).then(() => {
                this.isLoading = false
                this.$swal('Completado', 'La calificación ha sido guardada.', 'success');
                window.history.back()
            })
        }

    }
}
</script>

<style scoped>
.points {
    font-size: 2rem;
}
</style>
