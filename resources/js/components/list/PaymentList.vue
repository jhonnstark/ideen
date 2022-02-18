<template>
    <div class="container">
        <div class="row justify-content-center">

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
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
                    <td>{{ item.name }} {{ item.lastname }} {{ item.mothers_lastname }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.deactivated_at !== null ? 'Suspendido' : 'Activo' }}</td>
                    <td class="text-right">
                        <a :href="'/admin/' + role + '/register/' + item.id" class="btn btn-success" v-if="item.payments === null">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1600 736v192q0 40-28 68t-68 28h-416v416q0 40-28 68t-68 28h-192q-40 0-68-28t-28-68v-416h-416q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h416v-416q0-40 28-68t68-28h192q40 0 68 28t28 68v416h416q40 0 68 28t28 68z"/></svg>
                        </a>
                        <a :href="'/admin/bills/list/' + item.id" class="btn btn-primary" v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </a>
                        <button @click="erase(item.payments.id, item.id)" type="button" class="btn btn-danger" title="Borrar plan de pagos" v-if="item.payments !== null">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg>
                        </button>
                        <button @click="suspend(item.id, item.deactivated_at)" type="button" class="btn" :class="item.deactivated_at === null ? 'btn-danger': 'btn-secondary'" title="Suspender alumno">
                            <svg v-if="item.deactivated_at !== null" width="18" height="16" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1152 896q0-104-40.5-198.5t-109.5-163.5-163.5-109.5-198.5-40.5-198.5 40.5-163.5 109.5-109.5 163.5-40.5 198.5 40.5 198.5 109.5 163.5 163.5 109.5 198.5 40.5 198.5-40.5 163.5-109.5 109.5-163.5 40.5-198.5zm768 0q0-104-40.5-198.5t-109.5-163.5-163.5-109.5-198.5-40.5h-386q119 90 188.5 224t69.5 288-69.5 288-188.5 224h386q104 0 198.5-40.5t163.5-109.5 109.5-163.5 40.5-198.5zm128 0q0 130-51 248.5t-136.5 204-204 136.5-248.5 51h-768q-130 0-248.5-51t-204-136.5-136.5-204-51-248.5 51-248.5 136.5-204 204-136.5 248.5-51h768q130 0 248.5 51t204 136.5 136.5 204 51 248.5z"/></svg>
                            <svg v-else width="18" height="16" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M0 896q0-130 51-248.5t136.5-204 204-136.5 248.5-51h768q130 0 248.5 51t204 136.5 136.5 204 51 248.5-51 248.5-136.5 204-204 136.5-248.5 51h-768q-130 0-248.5-51t-204-136.5-136.5-204-51-248.5zm1408 512q104 0 198.5-40.5t163.5-109.5 109.5-163.5 40.5-198.5-40.5-198.5-109.5-163.5-163.5-109.5-198.5-40.5-198.5 40.5-163.5 109.5-109.5 163.5-40.5 198.5 40.5 198.5 109.5 163.5 163.5 109.5 198.5 40.5z"/></svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
export default {
    name: "PaymentList",
    props: ['role'],
    data: function () {
        return {
            isLoading: true,
            items: null
        }
    },
    created () {
        axios
            .get('/admin/' + this.role + '/list')
            .then(response => {
                console.log(response.data)
                this.items = response.data.data
            })
            .catch(respose => {
                this.items = [];
                console.log(respose);
            })
            .finally(() => this.isLoading = false)
    },
    methods: {
        erase(id, itemId) {
            this.$swal({
                title: '<i>Borrar</i>',
                text: 'Será borrado el plan de pagos',
                icon: 'danger',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                focusConfirm: false,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return axios
                        .delete('/admin/' + this.role + '/delete/' + id)
                        .then(response => {
                            this.$swal('Guardado', 'Borrado exitosamente.', 'success');
                            this.items = this.items.map((item) => {
                                if (item.id === itemId) {
                                    item.payments = null;
                                }
                                return item;
                            });
                        })
                        .catch(error => {
                            this.$swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            });
        },
        suspend(id, deactivated_at) {
            let title = '<i>Suspender</i>';
            let text = 'Será suspendida la cuenta';
            let icon = 'warning';
            if (deactivated_at !== null) {
                title = '<i>Activar</i>';
                text = 'La cuenta será activada';
                icon = 'info';
            }

            this.$swal({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                focusConfirm: false,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return axios
                        .put('/admin/' + this.role + '/suspend/' + id)
                        .then(response => {
                            this.$swal('Guardado', 'Suspendido exitosamente.', 'success');
                            this.items = this.items.map((item) => {
                                if (item.id === id) {
                                    item.deactivated_at = response.data.data
                                }
                                return item;
                            });
                        })
                        .catch(error => {
                            this.$swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            });
        }
    }
}
</script>

<style scoped>

</style>
