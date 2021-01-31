<template>
    <div class="text-center">
        <div class="card text-left" v-if="exam.id">
            <div class="card-header">
                {{ exam.name }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p>Instrucciones: {{ exam.description }}</p>
                            <p>Evaluado por: {{ exam.teacher.name }} {{ this.exam.teacher.lastname }} {{ this.exam.teacher.mothers_lastname }}</p>
                        </div>
                    </div>
                </div>
                <hr>
                <question v-for="question in exam.questions" :question="question" :key="question.id"></question>
                <hr>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="button"
                                :class="[ isLoading? 'btn-secondary' : 'btn-primary']"
                                class="btn"
                                @click="finishExamed"
                        >
                            <svg
                                v-if="isLoading"
                                class="spin btn-loading"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                            Completar
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <loader v-else></loader>
    </div>

</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('User')

export default {
    name: "StartExam",
    props: ['id'],
    data() {
        return {
            isLoading: false
        }
    },
    created() {
        this.startExam(this.id)
            .catch(error => console.log(error))
    },
    computed: {
        ...mapState({
            exam: state => state.exam,
        })
    },
    methods: {
        ...mapActions([
            'startExam',
            'finishExam'
        ]),

        finishExamed(){

            this.finishExam(this.id + '/finish')
            .then(() => {
                this.$swal('Completado', 'Respuestas salvadas exitosamente.', 'success');
                window.history.back()
            })
        }
    }
}
</script>

<style scoped>

</style>
