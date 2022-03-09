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
                    v-if="!$v.record.email.isUnique"
                    class="invalid-feedback" role="alert">
                    <strong>Email ya registrado</strong>
                </span>

                <span
                    v-else-if="!$v.record.email.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div v-if="role !== 'admins' && role !== 'personnels' && role !== 'finances'">
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.phone.$model"
                        :class="{ 'is-invalid': $v.record.phone.$error }"
                        id="phone" type="text" class="form-control" name="phone" required autocomplete="phone">

                    <span
                        v-if="!$v.record.phone.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="enrollment" class="col-md-4 col-form-label text-md-right">Matricula</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.enrollment.$model"
                        :class="{ 'is-invalid': $v.record.enrollment.$error }"
                        id="enrollment" type="text" class="form-control" name="enrollment" required autocomplete="enrollment">

                    <span
                        v-if="!$v.record.enrollment.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <!--        <div class="form-group row">-->
            <!--            <label for="inputGroupFile01" class="col-md-4 col-form-label text-md-right">Foto</label>-->
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

            <div class="form-group row">
                <hr class="col-12 form-separator">
            </div>

            <div class="form-group row">
                <div class="form-check form-check-inline col-md-3 offset-2" v-if="role === 'teacher'">
                    <input
                        v-model.trim="$v.record.degree_certificate.$model"
                        id="degree_certificate"
                        name="degree_certificate"
                        class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="degree_certificate">Título</label>
                </div>
                <div class="form-check form-check-inline col-md-3 offset-2" v-else>
                    <input
                        v-model.trim="$v.record.birth_certificate.$model"
                        id="birth_certificate"
                        name="birth_certificate"
                        class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="birth_certificate">Acta de nacimiento</label>
                </div>
                <div class="form-check form-check-inline col-md-3" v-if="role === 'teacher'">
                    <input
                        v-model.trim="$v.record.professional_license.$model"
                        id="professional_license"
                        name="professional_license"
                        class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="professional_license">Cedula profesional</label>
                </div>
                <div class="form-check form-check-inline col-md-3" v-else>
                    <input
                        v-model.trim="$v.record.school_certificate.$model"
                        id="school_certificate"
                        name="school_certificate"
                        class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="school_certificate">Certificado de estudios</label>
                </div>
                <div class="form-check form-check-inline col-md-3">
                    <input
                        v-model.trim="$v.record.curp_certificate.$model"
                        id="curp_certificate"
                        name="curp_certificate"
                        class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="curp_certificate">Curp</label>
                </div>
            </div>

            <div class="form-group row">
                <hr class="col-12 form-separator">
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.address.$model"
                        :class="{ 'is-invalid': $v.record.address.$error }"
                        id="address" type="text" class="form-control" name="address" required autocomplete="address">

                    <span
                        v-if="!$v.record.address.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="municipality" class="col-md-4 col-form-label text-md-right">Municipio</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.municipality.$model"
                        :class="{ 'is-invalid': $v.record.municipality.$error }"
                        id="municipality" type="text" class="form-control" name="municipality" required autocomplete="municipality">

                    <span
                        v-if="!$v.record.municipality.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="state" class="col-md-4 col-form-label text-md-right">Estado</label>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="state">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                            </label>
                        </div>
                        <v-select v-model="record.state_id" :reduce="state => state.id" label="name" id="state" name="state" :options="state"></v-select>

                        <span
                            v-if="!$v.record.state_id.error"
                            class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="birthday" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento</label>

                <div class="col-md-6">
                    <v-date-picker
                        v-model="birthday"
                        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                        min="1950-01-01"
                    >
                        <template v-slot="{ inputValue, inputEvents }">
                            <div class="date-picker">
                                <div class="date-picker-wrap">
                                    <svg
                                        class="mx-2"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        ></path>
                                    </svg>
                                    <input
                                        id="birthday"
                                        class="form-control date-picker-input"
                                        :value="inputValue"
                                        v-on="inputEvents"
                                        readonly
                                        name="birthday"
                                        required
                                    />
                                </div>
                            </div>
                        </template>
                    </v-date-picker>

                </div>
            </div>

            <div class="form-group row">
                <label for="birthplace" class="col-md-4 col-form-label text-md-right">Lugar de nacimiento</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.birthplace.$model"
                        :class="{ 'is-invalid': $v.record.birthplace.$error }"
                        id="birthplace" type="text" class="form-control" name="birthplace" required autocomplete="birthplace">

                    <span
                        v-if="!$v.record.birthplace.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="age" class="col-md-4 col-form-label text-md-right">Edad</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.age.$model"
                        :class="{ 'is-invalid': $v.record.age.$error }"
                        id="age" type="number" class="form-control" name="age" required autocomplete="age">

                    <span
                        v-if="!$v.record.age.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="emergency_phone" class="col-md-4 col-form-label text-md-right">Teléfono de emergencia</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.emergency_phone.$model"
                        :class="{ 'is-invalid': $v.record.emergency_phone.$error }"
                        id="emergency_phone" type="text" class="form-control" name="emergency_phone" required autocomplete="emergency_phone">

                    <span
                        v-if="!$v.record.emergency_phone.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="facebook" class="col-md-4 col-form-label text-md-right">facebook</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.facebook.$model"
                        :class="{ 'is-invalid': $v.record.facebook.$error }"
                        id="facebook" type="text" class="form-control" name="facebook" required autocomplete="facebook">

                    <span
                        v-if="!$v.record.facebook.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="curp" class="col-md-4 col-form-label text-md-right">Curp</label>

                <div class="col-md-6">
                    <input
                        v-model.trim="$v.record.curp.$model"
                        :class="{ 'is-invalid': $v.record.curp.$error }"
                        id="curp" type="text" class="form-control" name="curp" required autocomplete="curp">

                    <span
                        v-if="!$v.record.curp.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                </div>
            </div>

            <div class="form-group row">
                <hr class="col-12 form-separator">
            </div>

            <div v-if="role === 'teacher'">

                <div class="form-group row">
                    <label for="rfc" class="col-md-4 col-form-label text-md-right">RFC</label>

                    <div class="col-md-6">
                        <input
                            v-model.trim="$v.record.rfc.$model"
                            :class="{ 'is-invalid': $v.record.rfc.$error }"
                            id="rfc" type="text" class="form-control" name="rfc" required autocomplete="rfc">

                        <span
                            v-if="!$v.record.rfc.error"
                            class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="bank" class="col-md-4 col-form-label text-md-right">Nombre del banco</label>

                    <div class="col-md-6">
                        <input
                            v-model.trim="$v.record.bank.$model"
                            :class="{ 'is-invalid': $v.record.bank.$error }"
                            id="bank" type="text" class="form-control" name="bank" required autocomplete="bank">

                        <span
                            v-if="!$v.record.bank.error"
                            class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="account_number" class="col-md-4 col-form-label text-md-right">Número de cuenta</label>

                    <div class="col-md-6">
                        <input
                            v-model.trim="$v.record.account_number.$model"
                            :class="{ 'is-invalid': $v.record.account_number.$error }"
                            id="account_number" type="text" class="form-control" name="account_number" required autocomplete="account_number">

                        <span
                            v-if="!$v.record.account_number.error"
                            class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="account_clabe" class="col-md-4 col-form-label text-md-right">Cuenta CLABE</label>

                    <div class="col-md-6">
                        <input
                            v-model.trim="$v.record.account_clabe.$model"
                            :class="{ 'is-invalid': $v.record.account_clabe.$error }"
                            id="account_clabe" type="text" class="form-control" name="account_clabe" required autocomplete="account_clabe">

                        <span
                            v-if="!$v.record.account_clabe.error"
                            class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="!edit">
            <hr class="col-12 form-separator">
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
                <strong class="text-muted">Campo invalido</strong>
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
                <strong class="text-muted">Campo invalido</strong>
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

                    {{ isEdit ? 'Actualizar' : ' Agregar' }}
                </button>
            </div>
        </div>
    </form>

</template>

<script>

import {
    required,
    minLength,
    maxLength,
    sameAs,
    email,
    alphaNum,
    integer,
    minValue,
    requiredIf
} from 'vuelidate/lib/validators';

export default {
    name: "RegisterForm",
    props: ['role', 'edit', 'type'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                lastname: null,
                mothers_lastname: null,
                email: null,
                phone: null,
                enrollment: null,
                address: null,
                municipality: null,
                state_id: null,
                birthday: this.$moment(new Date()).format('YYYY-MM-DD'),
                birthplace: null,
                age: 1,
                emergency_phone: null,
                facebook: null,
                curp: null,
                rfc: null,
                bank: null,
                account_number: null,
                account_clabe: null,
                degree_certificate: false,
                birth_certificate: false,
                professional_license: false,
                school_certificate: false,
                curp_certificate: false,
                password: "",
                password_confirmation: null,

            },
            state: [],
            birthday: new Date(),
            rute: this.edit
                ? '/' + this.type + '/' + this.role + '/edit/' + this.edit
                : '/' + this.type + '/' + this.role + '/register',
            isLoading:false,
            emails: [],
        }
    },
    computed: {
        isEdit() {
            return !!this.edit;
        },
    },
    validations: {
        record: {
            name: {
                required,
                minLength: minLength(3),
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
            email: {
                required,
                email,
                minLength: minLength(6),
                maxLength: maxLength(255),
                isUnique() {
                    return this.emails.findIndex(element => this.record.email === element) < 0;
                },
            },
            phone: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                alphaNum,
                minLength: minLength(8),
                maxLength: maxLength(20)
            },
            enrollment: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                alphaNum,
                minLength: minLength(5),
                maxLength: maxLength(20)
            },
            address: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minLength: minLength(5),
                maxLength: maxLength(255)
            },
            municipality: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minLength: minLength(5),
                maxLength: maxLength(255)
            },
            state_id: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                integer
            },
            birthplace: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            age: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minValue: minValue(1),
            },
            emergency_phone: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minLength: minLength(5),
                maxLength: maxLength(255)
            },
            facebook: {
                minLength: minLength(5),
                maxLength: maxLength(255)
            },
            curp: {
                required: requiredIf(function () {
                    return this.role !== 'admins' && this.role !== 'personnels' && this.role !== 'finances'
                }),
                minLength: minLength(10),
                maxLength: maxLength(100)
            },
            rfc: {
                minLength: minLength(10),
                maxLength: maxLength(100)
            },
            bank: {
                minLength: minLength(3),
                maxLength: maxLength(100)
            },
            account_number: {
                minLength: minLength(10),
                maxLength: maxLength(100)
            },
            account_clabe: {
                minLength: minLength(10),
                maxLength: maxLength(100)
            },
            password: {
                minLength: minLength(6),
                maxLength: maxLength(255)
            },
            password_confirmation: {
                sameAsPassword: sameAs('password')
            },
            degree_certificate: {},
            birth_certificate: {},
            professional_license: {},
            school_certificate: {},
            curp_certificate: {},
        },
    },
    created() {
        if (this.edit) {
            axios.get('/' + this.type + '/' + this.role + '/edit/' + this.edit)
                .then(response => {
                    this.record = response.data.data;
                    this.birthday = response.data.data.birthday
                })
        }
        axios
            .get('/admin/state/list')
            .then(response => (this.state = response.data.data))
    },
    methods:{
        register() {
            if (this.isLoading) {
                return;
            }
            if (this.$v.$invalid
                || (!this.isEdit && this.record.password === '')) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data: this.record
                    })
                    .then(() => {
                        this.isLoading = false;
                        if (!this.edit) {
                            this.emails.push(this.record.email);
                            this.clearForm();
                            this.$swal('Guardado', 'Creado exitosamente.', 'success');
                        } else {
                            this.$swal('Actualizado', 'Guardado exitosamente.', 'success');
                        }
                    })
                    .catch(error => {
                        if (!this.edit && error.response.data.errors.email !== undefined) {
                            this.emails.push(this.record.email);
                            this.$v.$touch()
                        }
                    })
                    .finally(() => this.isLoading = false);
            }
        },
        clearForm() {
            this.birthday = new Date();
            this.record.name = null;
            this.record.email = null;
            this.record.lastname = null;
            this.record.mothers_lastname = null;
            this.record.phone = null;
            this.record.enrollment = null;
            this.record.address = null;
            this.record.municipality = null;
            this.record.state_id = null;
            this.record.birthplace = null;
            this.record.age = 1;
            this.record.emergency_phone = null;
            this.record.facebook = null;
            this.record.curp = null;
            this.record.rfc = null;
            this.record.bank = null;
            this.record.account_number = null;
            this.record.account_clabe = null;
            this.record.degree_certificate = false;
            this.record.birth_certificate = false;
            this.record.professional_license = false;
            this.record.school_certificate = false;
            this.record.curp_certificate = false;
            this.record.password = "";
            this.record.password_confirmation = null;
        }
    },
    watch: {
        birthday: function (val) {
            this.record.birthday = this.$moment(val).format('YYYY-MM-DD');
        }
    }
}
</script>

<style scoped>

</style>
