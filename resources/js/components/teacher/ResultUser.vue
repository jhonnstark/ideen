<template>
    <div class="row justify-content-between">
        <div class="col-12">
            <p>La calificación final es: <b>{{ result }}</b></p>
        </div>

        <div class="col-12">
            <form
                @submit.prevent="register"
                action="#" method="POST" novalidate>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input
                                v-model.trim="$v.extra.$model"
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
                                :class="[ !isLoading ? 'btn-primary': 'btn-secondary']"
                                class="btn">
                            <svg
                                v-if="isLoading"
                                class="spin btn-loading"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 2.5a5.487 5.487 0 00-4.131 1.869l1.204 1.204A.25.25 0 014.896 6H1.25A.25.25 0 011 5.75V2.104a.25.25 0 01.427-.177l1.38 1.38A7.001 7.001 0 0114.95 7.16a.75.75 0 11-1.49.178A5.501 5.501 0 008 2.5zM1.705 8.005a.75.75 0 01.834.656 5.501 5.501 0 009.592 2.97l-1.204-1.204a.25.25 0 01.177-.427h3.646a.25.25 0 01.25.25v3.646a.25.25 0 01-.427.177l-1.38-1.38A7.001 7.001 0 011.05 8.84a.75.75 0 01.656-.834z"></path></svg>
                            <span v-if="!isLoading">Calificar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions, mapMutations } = createNamespacedHelpers('Teacher')
import { required } from 'vuelidate/lib/validators';

export default {
    name: "ResultUser",
    props: ['activities', 'grades'],
    data: function () {
        return {
            extra: false,
            result: 0,
            isLoading: true,
        }
    },
    validations: {
        result: {
            required
        },
        extra: {}
    },
    created () {
        this.setActivities(this.activities)
        this.setGrades(this.grades)
        this.isLoading = false
    },
    methods:{
        register() {
            if (this.$v.$invalid) {
                this.errors = true;
            } else {
                this.$v.$reset();
                this.errors = false;
                this.isLoading = true;
                this.saveResult({
                    result: this.result
                })
                    .then(() => {
                        this.isLoading = false;
                        this.$swal('Guardado', 'Calificado exitosamente.', 'success');
                    })
                    .catch(error => console.log(error))
            }
        },

        ...mapMutations([
           'setActivities',
           'setGrades',
        ]),

        ...mapActions([
            'saveResult',
        ]),
    },
    watch: {
        extra() {
            this.result = this.extra ? 1 : 0
        }
    },
}
</script>

<style scoped>

</style>
