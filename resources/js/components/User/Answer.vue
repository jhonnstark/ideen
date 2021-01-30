<template>
    <div class="row">
        <div v-for="answer in answers" class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" :for="'answer-' + answer.id">
                        <input
                            type="radio"
                            :id="'answer-' + answer.id"
                            :name="'answer-' + question"
                            v-model="result"
                            :value="answer.option"
                            :aria-label="answer.option"
                            @click="inputClick(answer.id)"
                        >
                    </label>
                </div>
                <p class="form-control">{{ answer.option }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
import _ from "lodash";

const { mapState, mapActions } = createNamespacedHelpers('User')

export default {
    props: ['answers', 'question'],
    name: "Answer",
    data() {
        return {
            claim: '',
            result: ''
        }
    },
    computed: {
        ...mapState({
            claims: state => state.claims,
        })
    },
    created() {
        this.throttledMethod = _.debounce(() => {
            let vm = this;
            const data = {
                question: vm.question,
                claim: vm.claim
            }
            this.saveClaim(data)
        }, 1000)
        this.loadClaim(this.question).then(() => {
            const claimApi = this.claims.find(claim => claim.question_id === this.question)
            this.result = claimApi.profess
        })
    },
    methods: {

        ...mapActions([
            'saveClaim',
            'loadClaim',
        ]),

        throttledMethod() {

        },

        inputClick(answer_id) {
            this.claim = answer_id
            this.throttledMethod()
        }
    }
}
</script>

<style scoped>

</style>
