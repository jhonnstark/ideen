<template>
    <div class="container">
        <div class="row justify-content-center" v-if="type === 'admin' || type === 'finance'">
            <div class="col">
                <bill-form :role="role" :id="id" :payment="payment" v-on:bill-added="updateList" :type="type"></bill-form>
                <hr class="col-12">
            </div>
        </div>
        <div class="row justify-content-center" v-if="type === 'admin' || type === 'finance'">
            <div class="col">
                <concept-add :role="role" :id="id" v-on:concept-added="updateList" :type="type"></concept-add>
                <hr class="col-12">
            </div>
        </div>
        <div class="row justify-content-center" v-if="type === 'admin' || type === 'finance'">
            <div class="col">
                <custom-concept-add :role="role" :id="id" v-on:concept-added="updateList" :type="type"></custom-concept-add>
                <hr class="col-12">
            </div>
        </div>

        <div class="row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Concepto</th>
                    <th scope="col" class="text-right">Precio</th>
                    <th scope="col" class="text-right">Descuento</th>
                    <th scope="col" class="text-right">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-right">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="isLoading">
                    <td v-for="n in 7" class="text-center">
                        <svg class="spin loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                    </td>
                </tr>

                <tr v-else-if="items.length === 0">
                    <td colspan="7" class="text-center">
                        Lista vacía.
                    </td>
                </tr>

                <tr v-else v-for="item in items" :key="item.id">
                    <td>{{ type === 'user' ? '>' : item.id }}</td>
                    <td>{{ item.description }}</td>
                    <td class="text-right">$ {{ Number.parseFloat(item.price).toFixed(2) }}</td>
                    <td class="text-right">{{ item.discount }} %</td>
                    <td class="text-right">$ {{ Number.parseFloat(item.total).toFixed(2) }}</td>
                    <td class="text-center">
                        <b v-if="item.paid_at">Pagado</b>
                        <em v-else>Adeudo</em>
                    </td>
                    <td class="text-right">
                        <a :href="baseIRL + '/paid/' + item.id" class="btn btn-primary" v-if="item.paid_at !== null" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </a>
                        <button @click="paid(item.id)" type="button" class="btn btn-ideen" v-else-if="type === 'admin' || type === 'finance'">
                            <svg
                                v-if="isGenerating === item.id"
                                class="spin btn-loading"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                            <svg v-else width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z"/></svg>
                            Generar Recibo
                        </button>
                        <button @click="erase(item.id)" type="button" class="btn btn-danger" v-if="item.paid_at === null && (type === 'admin' || type === 'finance')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18"><path fill-rule="evenodd" d="M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z"></path></svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import ConceptAdd from "../form/ConceptAdd";
export default {
    name: "BillsList",
    components: {ConceptAdd},
    props: {
        role: {
            required: true,
        },
        id: {
            required: true,
        },
        payment: {
            required: true,
        },
        type: {
            default: 'admin'
        },
    },
    data: function () {
        return {
            isLoading: true,
            items: null,
            isGenerating: false,
            baseIRL: this.type !== 'user' ? '/' + this.type + '/' + this.role : '/' + this.role,
        }
    },
    created () {
        this.updateList();
    },
    methods: {
        updateList () {
            this.isLoading = true;
            axios
                .get(this.baseIRL + '/list/' + this.id + '/bills')
                .then(response => (this.items = response.data.data))
                .catch(() => this.items = [])
                .finally(() => this.isLoading = false);
        },
        paid(id) {
            if (this.isGenerating) {
                return;
            }
            this.isGenerating = id
            axios
                .put(this.baseIRL + '/paid/' + id)
                .then(response => {
                    this.$swal('Guardado', 'Recibo generado exitosamente.', 'success');
                    this.items = this.items.map((item) => {
                        if (item.id === id) {
                            item.paid_at = response.data.data.paid_at
                        }
                        return item;
                    });
                })
                .catch(error => {
                    this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
                .finally(() => this.isGenerating = false);
        },
        erase(id) {
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
                        .delete(this.baseIRL + '/delete/' + id)
                        .then(response => {
                            this.$swal('Guardado', 'Se ha eliminado exitosamente.', 'success');
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
                    this.$swal('Borrado', 'Se ha eliminado', 'success')
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
