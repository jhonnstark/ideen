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
                    disabled
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
                    disabled
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
                    disabled
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
                    disabled
                    id="email" type="email" class="form-control" name="email" required autocomplete="email">

                <span
                    v-if="!$v.record.email.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Foto</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="form-group row" v-if="!edit">-->
<!--            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>-->

<!--            <div class="col-md-6">-->
<!--                <input-->
<!--                    v-model.trim="$v.record.password.$model"-->
<!--                    :class="{ 'is-invalid': $v.record.password.$error }"-->
<!--                    id="password" type="password" class="form-control" name="password" required autocomplete="new-password">-->

<!--                <span-->
<!--                    v-if="!$v.record.password.error"-->
<!--                    class="invalid-feedback" role="alert">-->
<!--                    <strong>Campo invalido</strong>-->
<!--                </span>-->

<!--            </div>-->
<!--        </div>-->

<!--        <div class="form-group row" v-if="!edit">-->
<!--            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmación</label>-->

<!--            <div class="col-md-6">-->
<!--                <input-->
<!--                    v-model.trim="$v.record.password_confirmation.$model"-->
<!--                    :class="{ 'is-invalid': $v.record.password_confirmation.$error }"-->
<!--                    id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">-->

<!--                <span-->
<!--                    v-if="!$v.record.password_confirmation.error"-->
<!--                    class="invalid-feedback" role="alert">-->
<!--                    <strong>Campo invalido</strong>-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->

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
                    Actualizar
                </button>
            </div>
        </div>
    </form>

</template>

<script>

import { required, minLength, maxLength, sameAs, email } from 'vuelidate/lib/validators';

export default {
    name: "TeacherProfileForm",
    props: ['id'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                email: null,
                lastname: null,
                mothers_lastname: null,
                //password: "",
                //password_confirmation: null,
            },
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
            // password: {
            //     minLength: minLength(6),
            //     maxLength: maxLength(255)
            // },
            // password_confirmation: {
            //     sameAsPassword: sameAs('password')
            // },
        },
    },
    created() {
        axios.get('/teacher/profile/info')
            .then(response => {
                this.record = response.data.data;
            })
    },
    methods:{
        register() {
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                // axios({
                //     method: 'put',
                //     url:  this.rute,
                //     data: this.record
                //     }).then(response => {
                //         alert('Guardado');
                //     })
                //     .catch(error => console.log(error))
            }
        }
    },
    computed: {
    }
}
</script>

<style scoped>

</style>
