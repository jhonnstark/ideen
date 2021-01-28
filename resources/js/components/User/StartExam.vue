<template>
    <div class="card" v-if="exam.id">
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
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('User')

export default {
    name: "StartExam",
    props: ['id'],
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
        ]),
    }
}
</script>

<style scoped>

</style>
