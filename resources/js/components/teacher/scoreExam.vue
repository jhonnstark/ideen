<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="card text-left" v-if="score.id">
                    <div class="card-header">
                        {{ score.exam.name }}
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <p>Descripción:</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <loader v-else></loader>
            </div>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('Teacher')

export default {
    name: "scoreExam",
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
