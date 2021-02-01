<template>

    <div class="row">
        <div class="col-1">
            <strong class="card-number">{{ index + 1 }}.-</strong>
        </div>
        <div class="col-11">
            <strong class="card-title">Pregunta: {{ question.quiz }}</strong>
            <p class="card-subtitle">{{ question.type === 'choice' ? 'Opción multiple' : 'Abierta'}}</p>

            <div v-if="question.type === 'choice'" class="upperspace">
                <strong>Opciones correctas:</strong>
                <ul>
                    <li v-for="answer in question.answers" v-if="answer.correct">
                        <p class="card-text">{{ answer.option }}</p>
                    </li>
                </ul>
            </div>

            <strong>Respuesta:</strong>
            <ul>
                <li v-for="claim in question.claims">{{ claim.profess }}</li>
            </ul>
        </div>

    </div>

</template>

<script>
export default {
    props: ['question', 'index'],
    name: "GradeQuestion"
}
</script>

<style scoped>
.upperspace {
    margin-top: 5px;
}
</style>
