<template>
    <div class="row">
        <div class="col-12">
            <label for="exampleFormControlTextarea1" class="form-group">
                <textarea v-model="$v.answer.$model" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </label>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import { required } from 'vuelidate/lib/validators';
import { createNamespacedHelpers } from "vuex";

const { mapState, mapActions } = createNamespacedHelpers('User')


export default {
    props: ['question'],
    name: "OpenAnswer",
    data() {
        return {
            answer: ''
        }
    },
    validations: {
        answer: {
            required,
        },
    },
    created() {
        this.throttledMethod = _.debounce(() => {
            let vm = this;
            const data = {
                question: vm.question,
                claim: vm.answer
            }
            console.log('created')
            this.saveClaim(data)
        }, 1000)
        this.loadClaim(this.question).then(() => {
            const claimApi = this.claims.find(claim => claim.question_id === this.question)
            this.answer = claimApi.profess
        })
    },
    mounted() {

    },
    computed: {
        ...mapState({
            claims: state => state.claims,
        })
    },
    watch: {
        answer() {
            if (this.$v.$invalid || !this.$v.$anyDirty) {
                return
            }
            this.throttledMethod()
        }
    },
    methods: {

        throttledMethod() {

        },

        ...mapActions([
            'saveClaim',
            'loadClaim'
        ]),
    }
}
</script>

<style scoped>

</style>
