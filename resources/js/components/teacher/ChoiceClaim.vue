<template>
    <div>
        <u>Opciones correctas:</u>
        <ul class="card-no-list">
            <li v-for="answer in answers" v-if="answer.correct">
                <p class="card-text">{{ answer.option }}</p>
            </li>
        </ul>

        <u>Respuesta:</u>
        <ul class="card-no-list">
            <li v-for="claim in claims">
                <p :class="claimClass ? 'text-success' : 'text-danger'">
                    {{ claim.profess }}
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers('Teacher')

export default {
    props: ['answers', 'claims'],
    name: "ChoiceClaim",
    computed: {
        claimClass() {
            const corrects = this.answers.filter(answer => answer.correct).map(answer => answer.option)
            return corrects.includes(this.claims[0].profess);
        },
    },
    created() {
        if(this.claimClass) {
            this.addScore(this.claims[0])
        } else {
            this.holdScore(this.claims[0])
        }
    },
    methods: {
        ...mapActions([
            'addScore',
            'holdScore'
        ]),
    }
}
</script>

<style scoped>

</style>
