<template>
    <div class="col-md-6">

        <form
            @submit.prevent="register"
            action="#"
            enctype="multipart/form-data"
            method="POST" novalidate>
            <input type="hidden" name="_token" :value="csrf">

            <div class="form-group row">
                <label for="score" class="col-md-4 col-form-label text-md-right">Calificación</label>

                <div class="col-md-6">
                    <input
                        v-model.trim.lazy="$v.score.$model"
                        :class="{ 'is-invalid': $v.score.$error }"
                        id="score"
                        type="number" class="form-control" name="score" step="any" min="0" max="10" required autocomplete="score" autofocus>

                    <span
                        v-if="!$v.score.error"
                        class="invalid-feedback" role="alert">
                    <strong>Campo invalido</strong>
                </span>
                </div>
            </div>

            <div class="form-group row mb-0">
                <span
                    v-if="$v.$invalid && errors"
                    class="text-danger offset-md-4" role="alert">
                    <strong>Completa el formulario</strong>
                </span>

                <div class="col-md-6 offset-md-4">
                    <button type="submit"
                            :class="[ !$v.$invalid? 'btn-primary': 'btn-secondary']"
                            class="btn">
                        <svg
                            v-if="isLoading"
                            class="spin btn-loading"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>

                        {{ isEdit ? ' Actualizar' : ' Calificar' }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
import { required, decimal, between } from 'vuelidate/lib/validators';

export default {
    name: "ScoreMaterial",
    props: ['id', 'edit'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            score: null,
            editForm: true,
            rute: window.location.pathname + '/score',
            isLoading:false
        }
    },
    validations: {
        score: {
            required,
            decimal,
            between: between(0, 10)
        }
    },
    created () {
        axios.get(this.rute)
            .then(response => {
                this.score = response.data.data;
            })
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
                this.isLoading = true;

                axios({
                    method: 'put',
                    url:  this.rute,
                    data: {
                        score: this.score
                    }
                }).then(response => {
                    this.isLoading = false;
                    if (!this.edit) {
                        this.editForm = true;
                        this.$swal('Guardado', 'Calificado exitosamente.', 'success');
                    } else {
                        this.$swal('Actualizado', 'Calificado exitosamente.', 'success');
                    }
                }).catch(error => console.log(error))
            }
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
