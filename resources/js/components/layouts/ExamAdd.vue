<template>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Formulario de creación de examenes</div>
            <div class="card-body">

                <form
                    @submit.prevent="register"
                    action="#" method="POST" novalidate>
                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                        <div class="col-md-6">
                            <input
                                v-model.trim="$v.record.exam.name.$model"
                                :class="{ 'is-invalid': $v.record.exam.name.$error }"
                                id="name"
                                type="text" class="form-control" name="name" required autocomplete="name" autofocus>

                            <span v-if="!$v.record.exam.name.error" class="invalid-feedback" role="alert">
                                <strong>Campo invalido</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                        <div class="col-md-6">
                            <textarea
                                v-model.trim="$v.record.exam.description.$model"
                                :class="{ 'is-invalid': $v.record.exam.description.$error }"
                                id="description"
                                rows="2"
                                class="form-control" name="description" required autocomplete="description" autofocus>
                            </textarea>

                            <span
                                v-if="!$v.record.exam.description.error"
                                class="invalid-feedback" role="alert">
                                <strong>Campo invalido</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course" class="col-md-4 col-form-label text-md-right">Cursos</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="course">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                             height="16">
                                            <path fill-rule="evenodd"
                                                  d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path>
                                        </svg>
                                    </label>
                                </div>
                                <v-select v-model="record.exam.course_id" :reduce="course => course.id" label="name"
                                          id="course" name="course" :options="courses"></v-select>

                                <span v-if="!$v.record.exam.course_id.error" class="invalid-feedback" role="alert">
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
                                {{ isEdit ? 'Actualizar' : ' Agregar' }}
                            </button>
                            <span v-if="$v.$invalid && errors" class="text-danger" role="alert">
                                <strong>Completa el formulario</strong>
                            </span>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</template>

<script>
import {integer, maxLength, minLength, required} from "vuelidate/lib/validators";
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "ExamAdd",
    props: ['edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                exam: {
                    name: null,
                    description:null,
                    course_id:null
                },
                rute: window.location.pathname
            },
            isEdit: !!this.edit
        }
    },
    validations: {
        record: {
            exam: {
                name: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(255)
                },
                course_id: {
                    required,
                    integer
                },
                description: {
                    required,
                    maxLength: maxLength(255)
                }
            }
        },
    },
    created() {
        if (this.edit) {
            axios.get('/admin/' + this.role + '/edit/' + this.edit)
                .then(response => {
                    this.record = response.data.data;
                })
        }
        this.getCurses();
    },
    methods: {
        register() {
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.saveExam(this.record).then(response => {
                    this.isEdit = true;
                    this.$swal('Guardado', 'Creado exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        },

        ...mapActions([
            'getCurses',
            'saveExam'
        ]),
    },
    computed: {

        ...mapGetters({
            courses: 'getAllCourses',
            exam: 'getExam'
        })
    }
}
</script>

<style scoped>

</style>
