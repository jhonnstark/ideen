<template>

    <div class="container">
        <div class="row justify-content-center">
            <exam-add></exam-add>
        </div>


        <div class="row justify-content-center">
            <h4>Preguntas</h4>
            <hr class="col-12">
        </div>
    </div>

</template>

<script>
import { mapState } from 'vuex'
import ExamAdd from "../layouts/ExamAdd";

export default {
    name: "ExamForm",
    props: ['course', 'edit'],
    components: {
        ExamAdd
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: false,
            record: {
                name: null,
            },
            rute: window.location.pathname
        }
    },
    computed: {

        ...mapState([
            'exam'
        ])

    }
}
</script>

<style scoped>

</style>
