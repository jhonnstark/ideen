<template>
    <div class="text-center">
        <div class="card text-left" v-if="exam.id">
            <div class="card-header">
                <h5 class="card-text">{{ exam.name }}</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p>Descripción: {{ exam.description }}</p>
                           </div>
                    </div>
                </div>
            </div>
        </div>
        <loader v-else></loader>

        <hr>
        <table class="table table-striped">
            <caption>Calificaciones</caption>
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Calificación</th>
                <th scope="col" class="text-center">Usuario</th>
                <th scope="col" class="text-right">Ver</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="isLoading">
                <td v-for="n in 4" class="text-center">
                    <svg class="spin loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                </td>
            </tr>

            <tr v-else-if="exam.scores.length === 0">
                <td colspan="4" class="text-center">
                    Lista vacía.
                </td>
            </tr>

            <tr v-else v-for="item in exam.scores" :key="item.id">
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.mark || 'Pendiente' }}</td>
                <td class="text-center">{{ item.user.name }} {{ item.user.lastname }}</td>
                <td class="text-right">
                    <a :href="'grade/' + item.id"
                       :class="item.mark >= 0 ? 'btn-success' : 'btn-primary'"
                       class="btn btn-sm">

                        <svg v-if="item.mark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M3.25 4a.25.25 0 00-.25.25v12.5c0 .138.112.25.25.25h2.5a.75.75 0 01.75.75v3.19l3.427-3.427A1.75 1.75 0 0111.164 17h9.586a.25.25 0 00.25-.25V4.25a.25.25 0 00-.25-.25H3.25zm-1.75.25c0-.966.784-1.75 1.75-1.75h17.5c.966 0 1.75.784 1.75 1.75v12.5a1.75 1.75 0 01-1.75 1.75h-9.586a.25.25 0 00-.177.073l-3.5 3.5A1.457 1.457 0 015 21.043V18.5H3.25a1.75 1.75 0 01-1.75-1.75V4.25zM12 6a.75.75 0 01.75.75v4a.75.75 0 01-1.5 0v-4A.75.75 0 0112 6zm0 9a1 1 0 100-2 1 1 0 000 2z"></path></svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm16.28-2.72a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z"></path></svg>

                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('Teacher')

export default {
    name: "GradeExam",
    props: ['id'],
    data() {
        return {
            isLoading: true,
        }
    },
    created() {
        this.gradeExam(this.id)
            .then(() => this.isLoading = false)
            .catch(error => console.log(error))
    },
    computed: {
        ...mapState({
            exam: state => state.exam,
        })
    },
    methods: {

        ...mapActions([
            'gradeExam',
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
