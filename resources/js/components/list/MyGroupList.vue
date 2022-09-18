<template>
    <div class="row justify-content-center">

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Programa</th>
                <th scope="col">Ciclo</th>
                <th scope="col" class="text-right">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="isLoading">
                <td v-for="n in 5" class="text-center">
                    <svg class="spin loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                </td>
            </tr>

            <tr v-else-if="items.length === 0">
                <td colspan="5" class="text-center">
                    Lista vacía.
                </td>
            </tr>

            <tr v-else v-for="item in items" :key="item.id">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{ item.name }}</td>
                    <td>{{ item.program.name }}</td>
                    <td>{{ item.cycle.name }}</td>
                    <td class="text-right">
                        <a :href="'/admin/group/edit/' + item.id" type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path></svg>
                        </a>
                        <button @click="erase(item.id)" type="button" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18"><path fill-rule="evenodd" d="M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z"></path></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default {
    name: "MyGroupList",
    props: ['role', 'user', 'type'],
    data: function () {
        return {
            isLoading: true,
            items: null
        }
    },
    mounted() {
        this.loadCourses()
    },
    methods: {
        loadCourses() {
            this.isLoading = true
            axios
                .get('/' + this.type + '/' + this.role + '/group/' + this.user)
                .then(response => (this.items = response.data.data))
                .finally(() => this.isLoading = false)
        },
        erase: function (id) {
            this.$swal({
                title: '<i>Eliminar</i>',
                text: 'Será borrado permanentemente',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                focusConfirm: false,
                showLoaderOnConfirm: true,
                preConfirm: () => {

                    return axios
                        .put('/' + this.type + '/' + this.role + '/group/' + this.user + '/detach', {
                            id
                        })
                        .then(response => {
                            const removedId = this.items.findIndex(item => item.id === id);
                            this.items.splice(removedId, 1);
                        })
                        .catch(error => {
                            this.$swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })

                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then((result) => {
                if(result.isConfirmed) {
                    this.$swal('Borrado', 'Se ha eliminado exitosamente', 'success')
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
