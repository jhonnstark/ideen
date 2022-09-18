<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <group-add :user="id" :type="type" v-on:group-added="updateList"></group-add>
                <hr class="col-12">
            </div>
        </div>
        <my-group-list :role="role" :user="id" :type="type" ref="myClassList"></my-group-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id', 'type'],
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
