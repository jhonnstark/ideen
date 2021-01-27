<template>
    <div class="container">
        <div class="row justify-content-center">

        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers('User')

export default {
    name: "StartExam",
    props: ['id'],
    created() {
        this.startExam(this.id)
            .then(() => {
                console.log('sdf')
            })
            .catch(error => console.log('hedhedh', error))
    },
    computed: {
        ...mapState({
            exam: state => state.exam,
        })
    },
    methods: {
        ...mapActions([
            'startExam',
        ]),
    }
}
</script>

<style scoped>

</style>
