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
            <label for="name" class="col-md-4 col-form-label text-md-right">Apellido</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.lastname.$model"
                    :class="{ 'is-invalid': $v.record.mothers_lastname.$error }"
                    id="lastname" type="text" class="form-control" name="lastname" required autocomplete="lastname" autofocus>

                <span
                    v-if="!$v.record.lastname.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Apellido materno</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.mothers_lastname.$model"
                    :class="{ 'is-invalid': $v.record.mothers_lastname.$error }"
                    id="mothers_lastname" type="text" class="form-control" name="mothers_lastname" required autocomplete="mothers_lastname" autofocus>

                <span
                    v-if="!$v.record.mothers_lastname.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.email.$model"
                    :class="{ 'is-invalid': $v.record.email.$error }"
                    :disabled=isEdit
                    id="email" type="email" class="form-control" name="email" required autocomplete="email">

                <span
                    v-if="!$v.record.email.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

            </div>
        </div>

        <div class="form-group row" v-if="!edit">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.password.$model"
                    :class="{ 'is-invalid': $v.record.password.$error }"
                    id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                <span
                    v-if="!$v.record.password.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

            </div>
        </div>

        <div class="form-group row" v-if="!edit">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmación</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.record.password_confirmation.$model"
                    :class="{ 'is-invalid': $v.record.password_confirmation.$error }"
                    id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                <span
                    v-if="!$v.record.password_confirmation.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <span
                v-if="$v.$invalid && errors"
                class="text-danger" role="alert">
                        <strong>Completa el formulario</strong>
                    </span>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        :class="[ !$v.$invalid? 'btn-primary': 'btn-secondary']"
                        class="btn">
                    {{ isEdit ? 'Actualizar' : ' Agregar' }}
                </button>
            </div>
        </div>
    </form>

</template>

<script>

import { required, minLength, maxLength, sameAs, email } from 'vuelidate/lib/validators';

export default {
    name: "RegisterForm",
    props: ['role', 'edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                email: null,
                lastname: null,
                mothers_lastname: null,
                password: "",
                password_confirmation: null,
            },
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
            email: {
                required,
                email,
                minLength: minLength(6),
                maxLength: maxLength(255)
            },
            lastname: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            mothers_lastname: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            password: {
                minLength: minLength(6),
                maxLength: maxLength(255)
            },
            password_confirmation: {
                sameAsPassword: sameAs('password')
            },
        },
    },
    created() {
        if (this.edit) {
            axios.get('/admin/' + this.role + '/edit/' + this.edit)
                .then(response => {
                    this.record = response.data.data;
                })
        }
    },
    methods:{
        register() {
            if (this.$v.$invalid
                || (!this.isEdit && this.record.password === '')) {
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
                            this.clearForm();
                        }
                        alert('Guardado');
                    })
                    .catch(error => console.log(error))
            }
        },
        clearForm() {
            this.record.name = null;
            this.record.email = null;
            this.record.lastname = null;
            this.record.mothers_lastname = null;
            this.record.password = null;
            this.record.password_confirmation = null;
        }
    },
    computed: {
        isEdit() {
            return !!this.edit;
        },
    }
}
</script>

<style scoped>

</style>
