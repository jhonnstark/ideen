<template>
    <form
        @submit.prevent="register"
        action="#" method="POST" novalidate>
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-group row">
            <label for="course" class="col-md-4 col-form-label text-md-right">Cursos</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="course">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                                <path fill-rule="evenodd"
                                      d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path>
                            </svg>
                        </label>
                    </div>
                    <v-select v-model="course_id"
                              :reduce="course => course.id"
                              label="name"
                              :options="courses"
                              id="course"
                              name="course"></v-select>

                    <span
                        v-if="!$v.course_id.error"
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
import {integer, required} from 'vuelidate/lib/validators';

export default {
    name: "CourseAdd",
    props: ['id'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            course_id: null,
            courses: [],
            rute: window.location.pathname + '/associate',
            isLoading:false
        }
    },
    validations: {
        course_id: {
            required,
            integer
        },
    },
    created() {
        axios
            .get('/admin/course/list')
            .then(response => (this.courses = response.data.data))
    },
    methods:{
        register() {
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                axios({
                    method: 'post',
                    url:  this.rute,
                    data: {
                        course_id: this.course_id
                    }
                }).then(response => {
                    this.$emit('course-added')
                    this.course_id = null;
                    this.isLoading = false;
                    this.$swal('Agregado', 'Se agrego al curso exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        }
    },
}
</script>

<style scoped>

</style>
