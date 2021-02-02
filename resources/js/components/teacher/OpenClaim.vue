<template>
    <div>
        <u>Respuesta:</u>
        <ul class="card-no-list">
            <li v-for="claim in claims">
                <p class="text-primary">
                    {{ claim.profess }}
                </p>
                <div class="btn-group" role="group" aria-label="calificar">
                    <button @click="addScore(claim)" type="button" class="btn btn-success">+1</button>
                    <button @click="holdScore(claim)" type="button" class="btn btn-secondary">0</button>
                    <button @click="removeScore(claim)" type="button" class="btn btn-danger">-1</button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers('Teacher')

export default {
    props: ['claims'],
    name: "OpenClaim",
    methods: {
        ...mapActions([
            'addScore',
            'holdScore',
            'removeScore'
        ]),
    }
}
</script>

<style scoped>

</style>
