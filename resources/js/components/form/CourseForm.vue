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
            <label for="category" class="col-md-4 col-form-label text-md-right">Categoría (Ciclo escolar)</label>
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
            <label for="level" class="col-md-4 col-form-label text-md-right">Nivel (Programa)</label>
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

                    <span
                        v-if="!$v.record.teacher_id.error"
                        class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="poster" class="col-md-4 col-form-label text-md-right">Poster</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input @change="selectPoster" type="file" class="custom-file-input" id="poster">
                        <label class="custom-file-label" for="poster">Choose file</label>
                    </div>
                </div>

                <span
                    v-if="!$v.record.poster.error"
                    class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        :class="[ canSubmit? 'btn-primary': 'btn-secondary']"
                        class="btn">

                    <svg
                        v-if="isLoading"
                        class="spin btn-loading"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                    {{ isEdit ? 'Actualizar' : ' Agregar' }}
                </button>
                <span
                    v-if="($v.$invalid || errors) && $v.$anyDirty"
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
                poster:null
            },
            teacher:[],
            level:[],
            category:[],
            poster: null,
            isLoading:false,
            progress: 0,
            uploading: this.progress === 0,
            determinate: true,
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
            teacher_id: {
                required,
                integer
            },
            active: {},
            poster: {}
        },
    },
    created() {
        if (this.edit) {
            axios.get('/admin/' + this.role + '/edit/' + this.edit + '/json')
                .then(response => {
                    this.record = response.data.data;
                    this.record.poster = null;
                    if (Array.isArray(response.data.data.teacher)
                        && response.data.data.teacher.length > 0)
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
            if(!this.canSubmit){
                return;
            }
            if (this.isLoading) {
                return;
            }
            if (this.$v.$invalid || (this.record.poster === null && !this.isEdit)) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;

                const data = new FormData();
                data.append('name', this.record.name);
                data.append('active', this.record.active);
                data.append('level_id', this.record.level_id);
                data.append('category_id', this.record.category_id);
                data.append('teacher_id', this.record.teacher_id);
                if(this.record.poster !== null) {
                    data.append('poster', this.record.poster);
                }
                this.isLoading = true;

                axios({
                    method: 'post',
                    url:  this.rute,
                    data,
                    onUploadProgress: this.onUploadProgress,
                    onDownloadProgress: this.onDownloadProgress,
                }).then(response => {
                    if (!this.edit) {
                        this.record.name = null;
                        this.record.level_id = null;
                        this.record.category_id = null;
                        this.record.teacher_id = null;
                        this.record.active = false;
                        this.record.poster = null;
                        this.$swal('Guardado', 'Creado exitosamente.', 'success');
                    } else {
                        this.$swal('Actualizado', 'Guardado exitosamente.', 'success');
                    }
                }).catch(error => {
                    console.log(error.response.data)
                    this.$swal('Error', 'Algo ha ido mal: ' + error.response.data.message, 'error');
                }).finally(() =>{
                    this.isLoading = false;
                })
            }
        },
        selectPoster(event) {
            this.errors = false;
            this.record.poster = event.target.files[0];
        },
        onUploadProgress (progressEvent) {
            this.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        },
        onDownloadProgress (progressEvent) {
            this.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        }
    },
    computed: {
        isEdit() {
            return !!this.edit;
        },
        canSubmit(){
            return !this.isLoading && !this.$v.$invalid && !this.errors && (this.record.poster !== null || this.isEdit);
        }
    }
}
</script>

<style scoped>

</style>
