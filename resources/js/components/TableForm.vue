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

import { required, minLength, maxLength } from 'vuelidate/lib/validators';

export default {
    name: "CourseForm",
    props: ['role', 'edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
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
                            this.record.active = false;
                        }
                        alert('Guardado');
                    })
                    .catch(error => console.log(error))
            }
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
