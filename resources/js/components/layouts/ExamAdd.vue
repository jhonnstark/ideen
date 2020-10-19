<template>

    <div class="col-md-9">
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
                                :class="{ 'is-invalid': $v.record.exam.name.$error}"
                                id="name"
                                type="text"
                                :disabled="record.isEdit"
                                class="form-control"
                                name="name" required autocomplete="name" autofocus>

                            <span v-if="!$v.record.exam.name.error" class="invalid-feedback" role="alert">
                                <strong>Campo invalido</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Instrucciones</label>

                        <div class="col-md-6">
                            <textarea
                                v-model.trim="$v.record.exam.description.$model"
                                :class="{ 'is-invalid': $v.record.exam.description.$error }"
                                id="description"
                                :disabled="record.isEdit"
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
                                <v-select
                                    v-model="record.exam.course_id"
                                    :reduce="course => course.id"
                                    :options="courses"
                                    :disabled="record.isEdit"
                                    label="name"
                                    id="course" name="course"></v-select>

                                <span v-if="!$v.record.exam.course_id.error" class="invalid-feedback" role="alert">
                                    <strong>Campo invalido</strong>
                                </span>
                            </div>
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

                                {{ record.isEdit ? 'Actualizar' : ' Agregar' }}
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
import { integer, maxLength, minLength, required } from "vuelidate/lib/validators";
import { mapActions, mapGetters } from 'vuex'

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
                rute: window.location.pathname,
                isEdit: !!this.edit,
            },
            editForm: true,
            isLoading:false
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
            this.editForm = false;
            this.loadExam(this.record.rute + (this.edit ? '/json' :''))
                .then(() => {
                    this.record.exam = this.exam;
                    this.loadQuestions(this.exam.id);
                })
        }
        this.getCurses();
    },
    methods: {
        register() {
            if(!this.editForm) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                this.editForm = false;
                this.saveExam(this.record).then(() => {
                    this.record.rute = '/admin/exam/edit/' + this.exam.id
                    this.record.isEdit = true;
                    this.isLoading = false;
                    this.$swal('Guardado', 'Creado exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        },

        ...mapActions([
            'getCurses',
            'saveExam',
            'loadExam',
            'loadQuestions'
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
