<template>
    <div class="container">
        <div class="row justify-content-center">

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" class="text-center">Descripción</th>
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
                    <td>{{ item.id }}</td>
                    <td class="name_exam">{{ item.name }}</td>
                    <td class="long_text">{{ item.description }}</td>
                    <td class="text-right">
                        <a :href="'exam/' + item.id" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13 8V6H7V4h6V2l3 3-3 3zM4 2H3v1h1V2zm7 5h1v6c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1v2h-1V1H2v9h9V7zm0 4H1v2h2v-1h3v1h5v-2zM4 6H3v1h1V6zm0-2H3v1h1V4zM3 9h1V8H3v1z"></path></svg>
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
    props: ['role', 'id'],
    name: "MyExamList",
    data: function () {
        return {
            isLoading: true,
            items: null
        }
    },
    created () {
        axios
            .get(this.id + '/exam')
            .then(response => (this.items = response.data.data))
            .finally(() => this.isLoading = false)
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
