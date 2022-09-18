<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <user-add :id="id" :role="role" :type="type" v-on:user-added="updateList"></user-add>
                <hr class="col-12">
            </div>
        </div>
        <my-student-list :role="role" :group="id" :type="type" ref="myClassList"></my-student-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id', 'type'],
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
