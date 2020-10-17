<template>

</template>

<script>
import { mapState } from 'vuex'

export default {
    name: "ExamForm",
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
