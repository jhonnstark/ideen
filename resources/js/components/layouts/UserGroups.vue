<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <group-add :user="id" v-on:group-added="updateList"></group-add>
                <hr class="col-12">
            </div>
        </div>
        <my-group-list :role="role" :user="id" ref="myClassList"></my-group-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id'],
    name: "UserGroups",
    methods: {
        updateList () {
            this.$refs.myClassList.loadCourses()
        }
    }
}
</script>

<style scoped>

</style>
