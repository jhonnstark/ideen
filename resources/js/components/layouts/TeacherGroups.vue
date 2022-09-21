<template>
    <div class="container user-groups">
        <div class="row">
            <div class="col">
                <group-add :user="id" :type="type" :role="role" v-on:group-added="updateList"></group-add>
                <hr class="col-12">
            </div>
        </div>
        <my-group-list :role="role" :user="id" :type="type" ref="myClassList"></my-group-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id', 'type'],
    name: "TeacherGroups",
    methods: {
        updateList () {
            this.$refs.myClassList.loadCourses()
        }
    }
}
</script>

<style scoped>

</style>
