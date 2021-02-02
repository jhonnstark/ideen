<template>

    <div class="row">
        <div class="col-1">
            <strong class="card-number">{{ index + 1 }}.-</strong>
        </div>
        <div class="col-11">
            <strong class="card-title">Pregunta: {{ question.quiz }}</strong>
            <p class="card-type"><small>{{ type }}</small></p>

            <div v-if="question.type === 'choice'">
                <u>Opciones correctas:</u>
                <ul class="card-no-list">
                    <li v-for="answer in question.answers" v-if="answer.correct">
                        <p class="card-text">{{ answer.option }}</p>
                    </li>
                </ul>
            </div>

            <u>Respuesta:</u>
            <ul class="card-no-list">
                <li v-for="claim in question.claims">
                    <p :class="question.type === 'open' ? 'text-primary' : claimClass ? 'text-success' : 'text-danger'">
                        {{ claim.profess }}
                    </p>
                </li>
            </ul>
        </div>

    </div>

</template>

<script>
export default {
    props: ['question', 'index'],
    name: "GradeQuestion",
    computed: {
        claimClass() {
            const corrects = this.question.answers.filter(answer => answer.correct).map(answer => answer.option)
            return corrects.includes(this.question.claims[0].profess);
        },
        type() {
            return this.question.type === 'choice' ? 'Opción multiple' : 'Abierta'
        }
    }
}
</script>

<style scoped>
.card-subtitle {
    margin-bottom: 10px;
}
.card-title {
    font-size: 1rem;
}
</style>
