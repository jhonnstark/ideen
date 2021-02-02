<template>

    <div class="row">
        <div class="col-1">
            <strong class="card-number">{{ index + 1 }}.-</strong>
        </div>
        <div class="col-11">
            <strong class="card-title">Pregunta: {{ question.quiz }}</strong>
            <p class="card-type"><small>{{ type }}</small></p>
            <choice-claim v-if="question.type === 'choice'" :answers="question.answers" :claims="question.claims"></choice-claim>
            <open-claim v-if="question.type === 'open'" :claims="question.claims"></open-claim>
        </div>

    </div>

</template>

<script>
export default {
    props: ['question', 'index'],
    name: "GradeQuestion",
    computed: {
        type() {
            return this.question.type === 'choice' ? 'Opción multiple' : 'Abierta'
        }
    },
}
</script>

<style scoped>
    .card-title {
        font-size: 1rem;
    }
</style>
