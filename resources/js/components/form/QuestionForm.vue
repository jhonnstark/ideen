<template>
    <div class="spacer">
        <form
            @submit.prevent="register"
            action="#" method="POST" novalidate>

            <div class="form-group row">
                <label :for="'quiz_' + question.id" class="col-md-3 col-form-label text-md-right">Pregunta</label>

                <div class="col-md-7">
                    <input
                        v-model.trim="$v.question.quiz.$model"
                        :class="{ 'is-invalid': $v.question.quiz.$error}"
                        :id="'quiz_' + question.id"
                        type="text"
                        :disabled="isEdit"
                        class="form-control"
                        name="quiz" required autocomplete="quiz" autofocus>

                    <span v-if="!$v.question.quiz.error" class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-3 col-form-label text-md-right">Tipo</label>
                <div class="col-md-7">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="type">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                     height="16">
                                    <path fill-rule="evenodd"
                                          d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path>
                                </svg>
                            </label>
                        </div>
                        <v-select
                            v-model="question.type"
                            :reduce="option => option.id"
                            :options="options"
                            :disabled="isEdit"
                            label="name"
                            id="type" name="type"></v-select>

                        <span v-if="!$v.question.type.error" class="invalid-feedback" role="alert">
                            <strong>Campo invalido</strong>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-7 offset-md-3">
                    <button type="submit"
                            :class="[ !$v.$invalid && $v.$anyDirty? 'btn-primary': 'btn-secondary']"
                            class="btn">
                        <svg
                            v-if="isLoading"
                            class="spin btn-loading"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                        <span v-if="!isLoading">{{ isEdit ? 'Actualizar' : ' Agregar' }}</span>
                    </button>
                    <button
                        @click="removeQuestion"
                        type="button"
                        class="btn btn-danger">
                        <svg
                            v-if="isDeleting"
                            class="spin btn-loading"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                        <span v-if="!isDeleting">Borrar</span>
                    </button>
                    <span v-if="$v.$invalid && errors" class="text-danger" role="alert">
                            <strong>Completa el formulario</strong>
                        </span>
                </div>
            </div>
        </form>

        <answer-list v-if="isSaved" :question="question.id"></answer-list>
        <div class="dropdown-divider"></div>
    </div>

</template>

<script>
import { maxLength, minLength, required } from "vuelidate/lib/validators";
import { mapActions } from 'vuex'
import AnswerList from "../list/AnswerList";

export default {
    props: ['question'],
    name: "QuestionForm",
    components: {
        AnswerList
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            rute: '/admin/question/register',
            options: [{
                    id: 'choice',
                    name: 'Opción multiple'
                },
                {
                    id: 'open',
                    name: 'Abierta'
                }],
            isEdit: false,
            editForm: true,
            isDeleting: false,
            isLoading: false
        }
    },
    validations: {
        question: {
            quiz: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(255)
            },
            type: {}
        }
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
            this.saveQuestion({
                question: this.question,
                rute: this.rute,
                isEdit: this.isEdit
            }).then(() => {
                    this.isEdit = true;
                    this.isLoading = false;
                    this.$swal('Guardado', 'Creado exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        },
        removeQuestion(){
            if (this.isDeleting) {
                return;
            }
            this.isDeleting = true;
            this.deleteQuestion(this.question.id).then(() => {
                this.isDeleting = false;
            })
        },
        ...mapActions([
            'saveQuestion',
            'deleteQuestion'
        ]),
    },
    computed: {
        isSaved() {
            return Number.isInteger(this.question.id) && this.question.type === "choice"
        }
    }
}
</script>

<style scoped>

</style>
