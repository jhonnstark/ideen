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

<!--        <div class="form-group row">-->
<!--            <label for="email" class="col-md-4 col-form-label text-md-right">Foto</label>-->
<!--            <div class="col-md-6">-->
<!--                <div class="input-group mb-3">-->
<!--                    <div class="input-group-prepend">-->
<!--                        <span class="input-group-text">Upload</span>-->
<!--                    </div>-->
<!--                    <div class="custom-file">-->
<!--                        <input type="file" class="custom-file-input" id="inputGroupFile01">-->
<!--                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <hr>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.payload.password.$model"
                    :class="{ 'is-invalid': $v.payload.password.$error }"
                    id="password" type="password" class="form-control" name="password" autocomplete="password">

                <span
                    v-if="!$v.payload.password.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmación</label>

            <div class="col-md-6">
                <input
                    v-model.trim="$v.payload.password_confirmation.$model"
                    :class="{ 'is-invalid': $v.payload.password_confirmation.$error }"
                    id="password-confirm" type="password" class="form-control" name="password_confirmation" >

                <span
                    v-if="!$v.payload.password_confirmation.error"
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

                    <svg
                        v-if="isLoading"
                        class="spin btn-loading"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                    Actualizar
                </button>
            </div>
        </div>
    </form>

</template>

<script>

import { required, minLength, maxLength, sameAs, email } from 'vuelidate/lib/validators';

export default {
    name: "ProfileForm",
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
            },
            payload: {
                password: '',
                password_confirmation: '',
            },
            rute: window.location,
            isLoading: false
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
        },
        payload: {
            password: {
                required,
                minLength: minLength(6),
                maxLength: maxLength(255)
            },
            password_confirmation: {
                required,
                sameAsPassword: sameAs('password')
            },
        }
    },
    created() {
        axios.get('/profile/info')
            .then(response => {
                this.record = response.data.data;
            })
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
                    method: 'put',
                    url:  this.rute,
                    data: this.payload,
                    headers: {'X-CSRF-TOKEN': this.csrf},
                    })
                    .then(() => {
                        this.payload.password = '';
                        this.payload.password_confirmation = '';
                        this.$swal('Guardado', 'Creado exitosamente.', 'success')
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.isLoading = false);
            }
        }
    },
    computed: {
    }
}
</script>

<style scoped>

</style>
