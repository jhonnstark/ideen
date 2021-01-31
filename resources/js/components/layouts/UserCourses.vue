<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <course-add :id="id" v-on:course-added="updateList"></course-add>
                <hr class="col-12">
            </div>
        </div>
        <my-class-list :role="role" :id="id" ref="myClassList"></my-class-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id'],
    name: "UserCourses",
    methods: {
        updateList () {
            this.$refs.myClassList.loadCourses()
        }
    }
}
</script>

<style scoped>

</style>
