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
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input
                        v-model.trim="$v.record.active.$model"
                        class="form-check-input" type="checkbox" name="active" id="active">

                    <label class="form-check-label" for="active">
                        Activo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="category" class="col-md-4 col-form-label text-md-right">Categoría</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="category">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.category_id" :reduce="category => category.id" label="name" id="category" name="category" :options="category"></v-select>

                    <span
                        v-if="!$v.record.category_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="level">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.level_id" :reduce="level => level.id" label="name" id="level" name="level" :options="level"></v-select>

                    <span
                        v-if="!$v.record.level_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="teacher" class="col-md-4 col-form-label text-md-right">Profesor</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="teacher">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </label>
                    </div>
                    <v-select v-model="record.teacher_id" :reduce="teacher => teacher.id" label="name" id="teacher" name="teacher" :options="teacher"></v-select>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        :class="[ !$v.$invalid? 'btn-primary': 'btn-secondary']"
                        class="btn">
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

import { required, minLength, maxLength, integer } from 'vuelidate/lib/validators';

export default {
    name: "CourseForm",
    props: ['role', 'edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                active: false,
                teacher_id:null,
                level_id:null,
                category_id:null,
            },
            teacher:[],
            level:[],
            category:[],
            rute: this.edit
                ? '/admin/' + this.role + '/edit/' + this.edit
                : '/admin/' + this.role + '/register'
        }
    },
    validations: {
        record: {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            level_id: {
                required,
                integer
            },
            category_id: {
                required,
                integer
            },
            teacher_id: {},
            active: {},
        },
    },
    created() {
        if (this.edit) {
            axios.get('/admin/' + this.role + '/edit/' + this.edit)
                .then(response => {
                    this.record = response.data.data;
                    this.record.teacher_id = response.data.data.teacher[0].id;
                })
        }
        axios
            .get('/admin/teacher/list')
            .then(response => (this.teacher = response.data.data))
        axios
            .get('/admin/level/list')
            .then(response => (this.level = response.data.data))
        axios
            .get('/admin/category/list')
            .then(response => (this.category = response.data.data))
    },
    methods:{
        register() {
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;

                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data: this.record
                }).then(response => {
                        if (!this.edit) {
                            this.record.name = null;
                            this.record.level_id = null;
                            this.record.category_id = null;
                            this.record.teacher_id = null;
                            this.record.active = false;
                        }
                        alert('Guardado');
                    })
                    .catch(error => console.log(error))
            }
        }
    },
}
</script>

<style scoped>

</style>
