<template>

    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-striped">
                <caption>Alumnos</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-right">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="isLoading">
                    <td v-for="n in 5" class="text-center">
                        <svg :id="n + '_svg'" class="spin loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                    </td>
                </tr>

                <tr v-else-if="students.length === 0">
                    <td colspan="5" class="text-center">
                        Lista vacía.
                    </td>
                </tr>

                <tr v-else v-for="student in students" :key="student.id">
                    <th scope="row">{{ student.id }}</th>
                    <td>{{ student.name }}</td>
                    <td>{{ student.lastname }}</td>
                    <td>{{ student.email }}</td>
                    <td class="text-right">
                        <a v-if="role !== ''" class="btn btn-primary" :href="id + '/student/' + student.id">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('Teacher')

export default {
    name: "StudentList",
    props: ['id', 'role'],
    data() {
        return {
            isLoading: true,
        }
    },
    created() {
        this.loadStudents(this.id)
            .then(() => this.isLoading = false)
            .catch(error => console.log(error))
    },
    computed: {
        ...mapState({
            students: state => state.students,
        })
    },
    methods: {
        ...mapActions([
            'loadStudents',
        ]),
    }
}
</script>

<style scoped>

</style>
