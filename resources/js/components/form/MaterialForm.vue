<template>

    <form
        @submit.prevent="register"
        action="#"
        enctype="multipart/form-data"
        method="POST" novalidate>
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
            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

            <div class="col-md-6">
                <textarea
                    v-model.trim="$v.record.description.$model"
                    :class="{ 'is-invalid': $v.record.description.$error }"
                    id="description"
                    rows="2"
                    class="form-control" name="description" required autocomplete="description" autofocus>
                </textarea>

                <span
                    v-if="!$v.record.description.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="material" class="col-md-4 col-form-label text-md-right">Material</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input @change="selectMaterial" type="file" class="custom-file-input" id="material">
                        <label class="custom-file-label" for="material">Choose file</label>
                    </div>
                </div>
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
    name: "MaterialForm",
    props: ['role', 'id', 'edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
                description: null,
                active: false,
                material: null
            },
            rute: this.edit
                ? '/admin/' + this.role + '/edit/' + this.edit
                : window.location.pathname
        }
    },
    validations: {
        record: {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            description: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(255)
            },
            active: {},
            material: {}
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

                const data = new FormData();
                data.append('name', this.record.name);
                data.append('description', this.record.description);
                data.append('active', this.record.active);
                data.append('course_id', this.id);
                data.append('material', this.record.material);

                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data
                }).then(response => {
                        if (!this.edit) {
                            this.record.name = null;
                            this.record.active = false;
                        }
                        alert('Guardado');
                    })
                    .catch(error => console.log(error))
            }
        },
        selectMaterial(event) {
            console.log('fdgxd')
            this.record.material = event.target.files[0];
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
