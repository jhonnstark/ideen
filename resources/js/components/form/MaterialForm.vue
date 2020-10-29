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

                <span
                    v-if="!$v.record.material.error"
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
            editForm: true,
            rute: window.location.pathname,
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
            description: {
                required,
                minLength: minLength(10),
                maxLength: maxLength(255)
            },
            active: {},
            material: {
                required,
            }
        },
    },
    created() {
        if (this.edit) {
            axios.get(this.rute)
                .then(response => {
                    this.record = response.data.data;
                })
        }
    },
    methods:{
        register() {
            if(!this.editForm) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.editForm = false;

                const data = new FormData();
                data.append('name', this.record.name);
                data.append('description', this.record.description);
                data.append('active', this.record.active);
                data.append('module_id', this.id);
                data.append('material', this.record.material);
                this.isLoading = true;

                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data
                }).then(response => {
                    this.isLoading = false;
                    if (!this.edit) {
                        this.record.name = null;
                        this.record.description = null;
                        this.record.active = false;
                        this.editForm = true;
                        this.$swal('Guardado', 'Creado exitosamente.', 'success');
                    } else {
                        this.$swal('Actualizado', 'Guardado exitosamente.', 'success');
                    }
                }).catch(error => console.log(error))
            }
        },
        selectMaterial(event) {
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
