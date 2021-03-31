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
            <label class="col-md-4 col-form-label text-md-right">Duración del curso</label>
            <div class="col-md-6">
                <v-date-picker
                    v-model="range"
                    is-range
                    mode="dateTime"
                    :minute-increment="5"
                    is-required
                    :attributes="attrs"
                    :select-attribute="selectDragAttribute"
                    :drag-attribute="selectDragAttribute"
                    @drag="dragValue = $event"
                    :min-date="minDate"
                >
                    <template v-slot:day-popover="{ format }">
                        <div>
                            {{ format(dragValue ? dragValue.start : range.start, 'MMM D') }}
                            -
                            {{ format(dragValue ? dragValue.end : range.end, 'MMM D') }}
                        </div>
                    </template>
                    <template v-slot="{ inputValue, inputEvents, updateValue }">
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
                                    name="active_at"
                                    :value="inputValue.start"
                                    v-on="inputEvents.start"
                                    class="form-control date-picker-input border w-32 rounded"
                                />
                            </div>
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
                                    name="close_at"
                                    :value="inputValue.end"
                                    v-on="inputEvents.end"
                                    class="form-control date-picker-input border w-32 rounded"
                                />
                            </div>
                        </div>
                    </template>
                </v-date-picker>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        :class="[ !$v.$invalid && $v.$anyDirty? 'btn-primary': 'btn-secondary']"
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

        <div class="card-progress-overlay" v-if="isLoading">
            <vue-ellipse-progress
                :progress="progress"
                :determinate="determinate"
                :size="180"
                color="#0fa5df"
                empty-color="#182254"
                thickness="5"
                :empty-thickness="3"
                lineMode="out 5"
                animation="rs 700 400"
                fontSize="2rem"
                :loading="uploading"
                :legend-formatter="({ currentValue }) => `${currentValue} %`"
            />
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
            range: {
               start: new Date(),
               end: new Date(),
            },
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
            progress: 0,
            determinate: true,
            isLoading:false,
            attrs: [
                {
                    key: 'today',
                    dot: true,
                    dates: new Date(),
                },
            ],
            dragValue: null,
            minDate: new Date()
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
            material: {
                required,
            }
        },
    },
    created() {
        if (this.edit) {
            axios.get(this.rute + '/json')
                .then(response => {
                    const record = response.data.data;
                    record.material = null;
                    this.record = record;
                    this.range = {
                        start: new Date(this.record.active_at),
                        end: new Date(this.record.close_at),
                    }
                    this.minDate = this.range.start
                })
            this.id = this.edit;
        }
    },
    methods:{
        register() {
            if(!this.editForm || !this.$v.$anyDirty) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.editForm = false;
                let data;

                if (!this.edit) {
                    data = new FormData();
                    data.append('name', this.record.name);
                    data.append('description', this.record.description);
                    data.append('module_id', this.id);
                    data.append('active_at', this.$moment(this.range.start).format('YYYY-MM-DD hh:mm:ss'));
                    data.append('close_at',  this.$moment(this.range.end).format('YYYY-MM-DD hh:mm:ss'));
                    data.append('material', this.record.material);
                } else {
                    data = this.record;
                    delete data.material;
                }
                this.isLoading = true;

                axios({
                    method: this.edit ? 'put' : 'post',
                    url:  this.rute,
                    data,
                    onDownloadProgress: this.onDownloadProgress,
                    onUploadProgress: this.onUploadProgress
                })
                .then(response => {
                    this.isLoading = false;
                    if (!this.edit) {
                        this.record.name = null;
                        this.record.description = null;
                        this.editForm = true;
                        this.range.start = new Date();
                        this.range.end = new Date();
                        this.$swal('Guardado', 'Creado exitosamente.', 'success');
                    } else {
                        this.$swal('Actualizado', 'Guardado exitosamente.', 'success');
                    }
                })
                .catch(error => {
                    console.log(error.response.data)
                    this.$swal('Error', 'Algo ha ido mal: ' + error.response.data.message, 'error');
                })
                .finally(() =>{
                    this.isLoading = false;
                    this.editForm = true;
                })
            }
        },
        selectMaterial(event) {
            this.record.material = event.target.files[0];
        },
        onUploadProgress (progressEvent) {
            this.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        },
        onDownloadProgress (progressEvent) {
            this.progress = progressEvent.total === 0 ? 0 : Math.round((progressEvent.loaded * 100) / progressEvent.total)
        },
    },
    computed: {
        isEdit() {
            return !!this.edit;
        },
        uploading () {
            return this.progress === 0;
        },
        selectDragAttribute() {
            return {
                popover: {
                    visibility: 'hover',
                    isInteractive: false, // Defaults to true when using slot
                },
            };
        },
    }
}
</script>

<style lang="scss" scoped>
.date-picker {
    display: flex;
    flex-flow: column;

    &-wrap {
        position: relative;
        flex-grow: 1;
    }

    &-input {
        padding-left: 2rem;
        margin-bottom: 10px;
    }

    svg {
        position: absolute;
        width: 1rem;
        height: 37px;
    }
}
</style>
