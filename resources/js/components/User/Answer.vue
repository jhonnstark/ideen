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
                            :aria-label="answer.option"
                            @click="saveClaim({ question, claim: answer.id})"
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

const { mapState, mapActions } = createNamespacedHelpers('User')

export default {
    props: ['answers', 'question'],
    name: "Answer",
    computed: {
        ...mapState({
            exam: state => state.exam,
        })
    },
    methods: {
        ...mapActions([
            'saveClaim',
        ]),
    }
}
</script>

<style scoped>

</style>
