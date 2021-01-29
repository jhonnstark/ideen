<template>
    <div class="option">
        <form
            @submit.prevent="register"
            action="#" method="POST" novalidate>

            <div class="form-group row">
                <label :for="'option_' + answer.id" class="col-md-2 col-form-label text-md-right">
                    Opción:
                </label>

                <div class="col-md-8">
                    <input
                        v-model.trim="$v.answer.option.$model"
                        :class="{ 'is-invalid': $v.answer.option.$error}"
                        :id="'option_' + answer.id"
                        type="text"
                        :disabled="isEdit"
                        class="form-control"
                        name="option" required autocomplete="option" autofocus>

                    <span v-if="!$v.answer.option.error" class="invalid-feedback" role="alert">
                        <strong>Campo invalido</strong>
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input
                            v-model.trim="$v.answer.correct.$model"
                            class="form-check-input" type="checkbox" name="correct" id="correct">

                        <label class="form-check-label" for="correct">
                            ¿ Es la correcta ?
                        </label>
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
                        @click="removeAnswer"
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
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import { mapActions } from "vuex";

export default {
    props: ['answer'],
    name: "AnswerForm",
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            isEdit: !!this.answer.created_at,
            rute: '',
            editForm: true,
            isDeleting: false,
            isLoading: false,
        }
    },
    validations: {
        answer: {
            option: {
                required,
            },
            correct: {}
        }
    },
    methods: {
        reRute(){
            this.rute = this.isEdit ? '/admin/answer/edit/' + this.answer.id : '/admin/answer/register'
        },
        register() {
            if(!this.editForm || !this.$v.$anyDirty) {
                return;
            }
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                this.editForm = false;
                this.saveAnswer({
                    answer: this.answer,
                    rute: this.rute,
                    isEdit: this.isEdit
                }).then(() => {
                    this.isEdit = true;
                    this.isLoading = false;
                    this.editForm = true;
                    this.$swal('Guardado', 'Creado exitosamente.', 'success');
                }).catch(error => console.log(error))
            }
        },
        removeAnswer(){
            if (this.isDeleting) {
                return;
            }
            this.isDeleting = true;
            this.deleteAnswer(this.answer).then(() => {
                this.isDeleting = false;
            })
        },
        ...mapActions([
            'saveAnswer',
            'deleteAnswer'
        ]),
    },
    watch: {
        isEdit() {
            this.reRute()
        }
    },
    created() {
        this.reRute()
    }
}
</script>

<style scoped>
.option {
    margin: 20px 0;
}
</style>
