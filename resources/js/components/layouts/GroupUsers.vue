<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <user-add :id="id" v-on:user-added="updateList"></user-add>
                <hr class="col-12">
            </div>
        </div>
        <student-list :role="role" :id="id" ref="myClassList"></student-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id'],
    name: "GroupUsers",
    methods: {
        updateList () {
            this.$refs.myClassList.loadCourses()
        }
    }
}
</script>

<style scoped>

</style>
