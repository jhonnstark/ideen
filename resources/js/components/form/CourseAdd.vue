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
            rute: window.location.pathname + '/associate'
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

                axios({
                    method: 'post',
                    url:  this.rute,
                    data: {
                        course_id: this.course_id
                    }
                }).then(response => {
                    //todo: update curses table when added
                        this.course_id = null;
                        this.$swal('Agregado', 'Se agrego al curso exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        }
    },
}
</script>

<style scoped>

</style>
