<template>
    <div class="container">
        <div class="row justify-content-center">

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.75 2.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h.94a.76.76 0 01.03-.03l6.077-6.078a1.75 1.75 0 012.412-.06L14.5 10.31V2.75a.25.25 0 00-.25-.25H1.75zm12.5 11H4.81l5.048-5.047a.25.25 0 01.344-.009l4.298 3.889v.917a.25.25 0 01-.25.25zm1.75-.25V2.75A1.75 1.75 0 0014.25 1H1.75A1.75 1.75 0 000 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25zM5.5 6a.5.5 0 11-1 0 .5.5 0 011 0zM7 6a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </th>
                    <th scope="col">Nombre</th>
                    <th scope="col" class="text-center">Alumnos</th>
                    <th scope="col" class="text-right">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="isLoading">
                    <td v-for="n in 4" class="text-center">
                        <svg class="spin loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                    </td>
                </tr>

                <tr v-else-if="items.length === 0">
                    <td colspan="4" class="text-center">
                        Lista vacía.
                    </td>
                </tr>
                <tr v-else v-for="item in items" :key="item.id">
                    <th scope="row" class="text-center">
                        <a :href="'/teacher/course/' + item.id" class="">
                            <img :src="item.url" :alt="item.name" class="poster">
                        </a>
                    </th>
                    <td>{{ item.name }}</td>
                    <td class="text-center">{{ item.student_count }}</td>
                    <td class="text-right">
                        <a :href="'/teacher/course/' + item.id" class="btn btn-primary btn-sm">
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
    name: "TeacherClassList",
    props: ['id'],
    data: function () {
        return {
            isLoading: true,
            items: null
        }
    },
    mounted () {
        axios
            .get('/teacher/courses/list')
            .then(response => (this.items = response.data.data))
            .finally(() => this.isLoading = false)
    },
    methods: {
        erase: function (id) {
            axios
                .put('/teacher/courses/' + this.id + '/detach/', {
                    id
                })
                .then(response => {
                    const removedId = this.items.findIndex(item => item.id === id);
                    this.items.splice(removedId, 1);
                })
        }
    }
}
</script>

<style scoped>

</style>
