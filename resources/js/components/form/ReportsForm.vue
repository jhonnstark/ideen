<template>

    <form
        @submit.prevent="register"
        action="#" method="POST" novalidate>
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="types" class="col-md-4 col-form-label text-md-right">Generar reporte</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="types">
                            <svg width="18" height="16" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M640 896v512h-256v-512h256zm384-512v1024h-256v-1024h256zm1024 1152v128h-2048v-1536h128v1408h1920zm-640-896v768h-256v-768h256zm384-384v1152h-256v-1152h256z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="type"
                              :options="types"
                              id="types"
                              name="types"
                              :dropdown-should-open=true
                    >
                    </v-select>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="type !== 'Por alumno'">
            <label for="orderBy" class="col-md-4 col-form-label text-md-right">Orden del reporte</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="orderBy">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1595 295q17 41-14 70l-493 493v742q0 42-39 59-13 5-25 5-27 0-45-19l-256-256q-19-19-19-45v-486l-493-493q-31-29-14-70 17-39 59-39h1280q42 0 59 39z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="ordered"
                              :options="orderBy"
                              id="orderBy"
                              name="orderBy"
                              :dropdown-should-open=true
                    >
                    </v-select>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="type === 'Por alumno' || ordered === 'Por alumno'">
            <label for="orderBy" class="col-md-4 col-form-label text-md-right">Busqueda de alumno</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="user">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1536 1399q0 109-62.5 187t-150.5 78h-854q-88 0-150.5-78t-62.5-187q0-85 8.5-160.5t31.5-152 58.5-131 94-89 134.5-34.5q131 128 313 128t313-128q76 0 134.5 34.5t94 89 58.5 131 31.5 152 8.5 160.5zm-256-887q0 159-112.5 271.5t-271.5 112.5-271.5-112.5-112.5-271.5 112.5-271.5 271.5-112.5 271.5 112.5 112.5 271.5z"/></svg>
                        </label>
                    </div>
                    <v-select v-model="user_id"
                              :reduce="user => user.id"
                              label="name"
                              :options="users"
                              id="user"
                              name="user"
                              :dropdown-should-open=true
                    >
                    </v-select>

                    <span
                        v-if="!$v.user_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        :class="[ !$v.$invalid? 'btn-primary': 'btn-secondary']"
                        class="btn">

                    <svg
                        v-if="isLoading"
                        class="spin btn-loading"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                    Generar
                </button>
                <span
                    v-if="$v.$invalid && errors"
                    class="text-danger" role="alert">
                        <strong>Completa el formulario</strong>
                    </span>
            </div>
        </div>
    </form>

</template>

<script>

import { required } from 'vuelidate/lib/validators';

export default {
    name: "TableForm",
    props: [],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            types: ['Por alumno', 'Semanal', 'mensual', 'anual'],
            orderBy: ['Por alumno', 'Por grupo', 'General'],
            users: [],
            user_id: null,
            ordered: null,
            type: null,
            isLoading:false
        }
    },
    validations: {
        user_id: {
            required,
        },
        type: {
            required,
        },
        ordered: {
            required,
        },
    },
    created() {
        axios.get('/admin/user/list/')
            .then(response => {
                this.users = response.data.data;
            })
    },
    methods:{
        register() {

        }
    },
    computed: {
    },
}
</script>

<style scoped>

</style>
