<template>

    <form
        @submit.prevent="register"
        action="#" method="POST" novalidate>
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">¿Pagó la inscripción?</label>

            <div class="col-md-6">
                <toggle-button
                    color="#0fa5df"
                    :sync="true"
                    :labels="{checked: 'Si', unchecked: 'No'}"
                    :height=30
                    :width=65
                    :font-size=13.5
                    v-model="paid"
                />
            </div>
        </div>

        <div class="form-group row" v-if="paid">
            <label for="invoice" class="col-md-4 col-form-label text-md-right">Folio de pago</label>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="price">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M991 1024l64-256h-254l-64 256h254zm768-504l-56 224q-7 24-31 24h-327l-64 256h311q15 0 25 12 10 14 6 28l-56 224q-5 24-31 24h-327l-81 328q-7 24-31 24h-224q-16 0-26-12-9-12-6-28l78-312h-254l-81 328q-7 24-31 24h-225q-15 0-25-12-9-12-6-28l78-312h-311q-15 0-25-12-9-12-6-28l56-224q7-24 31-24h327l64-256h-311q-15 0-25-12-10-14-6-28l56-224q5-24 31-24h327l81-328q7-24 32-24h224q15 0 25 12 9 12 6 28l-78 312h254l81-328q7-24 32-24h224q15 0 25 12 9 12 6 28l-78 312h311q15 0 25 12 9 12 6 28z"/></svg>
                        </label>
                    </div>
                    <input
                        v-model.trim="$v.record.invoice.$model"
                        :class="{ 'is-invalid': $v.record.invoice.$error }"
                        id="invoice"
                        type="text" class="form-control" name="invoice" required autocomplete="invoice" autofocus>

                    <span
                        v-if="!$v.record.invoice.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row" v-else>
            <label for="signing_up" class="col-md-4 col-form-label text-md-right">Inscripción</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="signing_up">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z"/></svg>
                        </label>
                    </div>

                    <input
                        v-model.number.trim="$v.record.signing_up.$model"
                        :class="{ 'is-invalid': $v.record.signing_up.$error }"
                        id="signing_up"
                        type="text" class="form-control" name="signing_up" required autocomplete="signing_up-bill">

                    <span
                        v-if="!$v.record.signing_up.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="discount" class="col-md-4 col-form-label text-md-right">Descuento</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <v-select
                        v-model="record.discount"
                        id="scholarship"
                        name="scholarship"
                        :options="scholarship"
                        label="name"
                        :reduce="scholarship => scholarship.id"
                    ></v-select>

                    <span
                        v-if="!$v.record.discount.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-md-4 col-form-label text-md-right">Mesualidad sin beca</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="price">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z"/></svg>
                        </label>
                    </div>
                    <input
                        v-model.number.trim="$v.record.price.$model"
                        :class="{ 'is-invalid': $v.record.price.$error }"
                        id="price"
                        type="text" class="form-control" name="price" required autocomplete="price-bill">

                    <span
                        v-if="!$v.record.price.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="scholarship" class="col-md-4 col-form-label text-md-right">Beca</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <v-select
                        v-model="record.scholarship"
                        id="scholarship"
                        name="scholarship"
                        :options="scholarship"
                        label="name"
                        :reduce="scholarship => scholarship.id"
                    ></v-select>

                    <span
                        v-if="!$v.record.scholarship.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-md-4 col-form-label text-md-right">Total</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="price">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1362 1185q0 153-99.5 263.5t-258.5 136.5v175q0 14-9 23t-23 9h-135q-13 0-22.5-9.5t-9.5-22.5v-175q-66-9-127.5-31t-101.5-44.5-74-48-46.5-37.5-17.5-18q-17-21-2-41l103-135q7-10 23-12 15-2 24 9l2 2q113 99 243 125 37 8 74 8 81 0 142.5-43t61.5-122q0-28-15-53t-33.5-42-58.5-37.5-66-32-80-32.5q-39-16-61.5-25t-61.5-26.5-62.5-31-56.5-35.5-53.5-42.5-43.5-49-35.5-58-21-66.5-8.5-78q0-138 98-242t255-134v-180q0-13 9.5-22.5t22.5-9.5h135q14 0 23 9t9 23v176q57 6 110.5 23t87 33.5 63.5 37.5 39 29 15 14q17 18 5 38l-81 146q-8 15-23 16-14 3-27-7-3-3-14.5-12t-39-26.5-58.5-32-74.5-26-85.5-11.5q-95 0-155 43t-60 111q0 26 8.5 48t29.5 41.5 39.5 33 56 31 60.5 27 70 27.5q53 20 81 31.5t76 35 75.5 42.5 62 50 53 63.5 31.5 76.5 13 94z"/></svg>
                        </label>
                    </div>

                    <input
                        v-model.number.trim="$v.record.total.$model"
                        :class="{ 'is-invalid': $v.record.total.$error }"
                        id="total"
                        type="text"
                        disabled
                        class="form-control" name="total" required autocomplete="total-bill">

                    <span
                        v-if="!$v.record.total.error"
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

                    Agregar
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

import { required, minLength, maxLength, between, decimal, minValue, numeric, requiredIf, requiredUnless } from 'vuelidate/lib/validators';

export default {
    name: "CourseForm",
    props: ['role', 'id'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                invoice: null,
                signing_up: 0,
                discount: 0,
                price: 0,
                scholarship: 0,
                total: 0,
            },
            paid: true,
            scholarship: [
                {
                    id: 0,
                    name: '0%',
                },
                {
                    id: 10,
                    name: '10%',
                },
                {
                    id: 20,
                    name: '20%',
                },
                {
                    id: 30,
                    name: '30%',
                },
                {
                    id: 40,
                    name: '40%',
                },
            ],
            rute: '/admin/' + this.role + '/register/' + this.id,
            isLoading:false
        }
    },
    validations: {
        record: {
            invoice: {
                required: requiredIf('paid'),
                numeric,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            signing_up: {
                decimal,
                required: requiredUnless('paid'),
                minValue: minValue(0)
            },
            price: {
                required,
                decimal,
                minValue: minValue(0)
            },
            scholarship: {
                required,
                decimal,
                between: between(0, 40)
            },
            discount: {
                required,
                decimal,
                between: between(0, 40)
            },
            total: {
                required,
                decimal,
                minValue: minValue(0.01)
            },
        },
    },
    created() {
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
                if (this.paid) {
                    this.record.signing_up = 0;
                } else {
                    this.record.invoice = null;
                }

                axios({
                    method: 'post',
                    url:  this.rute,
                    data: this.record
                }).then(response => {
                    this.record.invoice = null;
                    this.record.signing_up = 0;
                    this.record.discount = 0;
                    this.record.price = 0;
                    this.record.scholarship = 0;
                    this.record.total = 0;
                    this.$swal('Guardado', 'Creado exitosamente.', 'success');
                }).catch(error => console.log(error))
                .finally(() =>{
                    this.isLoading = false;
                    window.location = '/admin/' + this.role
                });
            }
        },
    },
    watch: {
        record: {
            handler(val){
                this.record.price = parseFloat(this.record.price).toFixed(2);
                this.record.signing_up = parseFloat(this.record.signing_up).toFixed(2);
                const total = this.record.price * (1 - this.record.scholarship / 100);
                this.record.total = Number.parseFloat(total).toFixed(2);
            },
            deep: true
        }
    }
}
</script>

<style scoped>

</style>
