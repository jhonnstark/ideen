<template>
    <div class="row">
        <div class="col-12">
            <label for="exampleFormControlTextarea1" class="form-group">
                <textarea v-model="answer" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </label>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
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
    created() {
        this.throttledMethod = _.debounce(() => {
            let vm = this;
            console.log('I only get fired once every 1 second, max!')
            console.log(vm.question)
            console.log(vm.answer)
            const data = {
                question: vm.question,
                claim: vm.answer
            }
            console.log(data)
            this.saveClaim(data)
        }, 1000)
    },
    watch: {
        answer() {
            this.throttledMethod()
        }
    },
    methods: {

        throttledMethod() {

        },

        ...mapActions([
            'saveClaim',
        ]),
    }
}
</script>

<style scoped>

</style>
