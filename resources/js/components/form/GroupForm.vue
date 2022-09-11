<template>

    <form
        @submit.prevent="register"
        action="#" method="POST" novalidate>
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.name.$model"
                    :class="{ 'is-invalid': $v.record.name.$error }"
                    id="name"
                    type="text" class="form-control" name="name" required autocomplete="name" autofocus>

                <span
                    v-if="!$v.record.name.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="cycle" class="col-md-4 col-form-label text-md-right">Ciclo</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="cycle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.cycle_id" :reduce="cycle => cycle.id" label="name" id="cycle" name="cycle" :options="cycle"></v-select>

                    <span
                        v-if="!$v.record.cycle_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="program" class="col-md-4 col-form-label text-md-right">Programa</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="program">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.program_id" :reduce="program => program.id" label="name" id="program" name="program" :options="program"></v-select>

                    <span
                        v-if="!$v.record.program_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="this.record.program_id">
            <label for="quarter" class="col-md-4 col-form-label text-md-right">Cuatrimestre</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="quarter">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.quarter" :reduce="quarter => quarter.id" label="name" id="quarter" name="quarter" :options="quarter"></v-select>

                    <span
                        v-if="!$v.record.quarter.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="this.record.program_id">
            <label for="periods" class="col-md-4 col-form-label text-md-right">Periodos</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="periods">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.period" :reduce="period => period.id" label="name" id="periods" name="periods" :options="periods"></v-select>

                    <span
                        v-if="!$v.record.period.error"
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

                    {{ isEdit ? 'Actualizar' : ' Agregar' }}
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

import {required, minLength, maxLength, between, integer} from 'vuelidate/lib/validators';

export default {
    name: "GroupForm",
    props: {
        role: {
            type: String,
            require: true,
        },
        edit: String,
        type: {
            type: String,
            default: 'admin',
        }
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                quarter: null,
                period: null,
                program_id:null,
                cycle_id:null,
            },
            quarter: [],
            periods: [],
            program:[],
            cycle:[],
            rute: this.edit
                ? '/' + this.type + '/' + this.role + '/edit/' + this.edit
                : '/' + this.type + '/' + this.role + '/register',
            isLoading:false
        }
    },
    validations: {
        record: {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            quarter: {
                required,
                between: between(1, 9)
            },
            period: {
                required,
                between: between(1, 3)
            },
            program_id: {
                required,
                integer
            },
            cycle_id: {
                required,
                integer
            },
        },
    },
    created() {
        if (this.edit) {
            axios.get(this.rute + '/json').then(({ data: { data } }) => this.record = data);
        }
        axios
            .get('/' + this.type + '/program/list')
            .then(({ data: { data } })=> (this.program = data))
        axios
            .get('/' + this.type + '/cycle/list')
            .then(({ data: { data } })=> (this.cycle = data))
    },
    methods:{
        register() {
            if (this.isLoading) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data: this.record
                }).then(response => {
                    if (!this.edit) {
                        this.record.name = null;
                        this.record.quarter = null;
                        this.record.period = null;
                        this.record.program_id = null;
                        this.record.cycle_id = null;
                        this.$swal('Guardado', 'Creado exitosamente.', 'success');
                    } else {
                        this.$swal('Actualizado', 'Guardado exitosamente.', 'success');
                    }
                }).catch((error) => {
                    console.log(error.response.data)
                    this.$swal('Error', 'Algo ha ido mal: ' + error.response.data.message, 'error');
                }).finally(() => {
                    this.isLoading = false;
                })
            }
        }
    },
    computed: {
        isEdit() {
            return !!this.edit;
        },
    },
    watch: {
        'record.program_id'(newProgram) {
            if (newProgram) {
                const {quarts, periods} = this.program.find(program => program.id === newProgram);
                this.quarter = Array.from({length: quarts}, (_, i) => ({
                    id: (i + 1),
                    name: (i + 1) + 'ª Cuatrimestre'
                }));
                this.periods = Array.from({length: periods}, (_, i) => ({
                    id: (i + 1),
                    name: (i + 1) + 'ª Periodo'
                }));
                this.record.period = null;
                this.record.quarter = null;
            }
        },
    }
}
</script>

<style scoped>

</style>
