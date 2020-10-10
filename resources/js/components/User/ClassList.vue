<template>
    <div class="container">
        <div class="row justify-content-center">

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" class="text-center">Profesor</th>
                    <th scope="col" class="text-right">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items" :key="item.id">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{ item.name }}</td>
                    <td class="text-center">
                        <span v-for="teacher in item.teacher" :key="teacher.id">
                            {{ teacher.name }}
                        </span>
                    </td>
                    <td class="text-right">
                        <a :href="'/course/' + item.id"  class="btn btn-primary btn-sm">
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
export default {
    name: "ClassList",
    props: ['id'],
    data: function () {
        return {
            items: null
        }
    },
    mounted () {
        axios
            .get('/courses/list')
            .then(response => (this.items = response.data.data))
    },
}
</script>

<style scoped>

</style>
