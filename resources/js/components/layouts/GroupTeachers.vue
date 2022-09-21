<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <teacher-add :id="id" :role="role" :type="type" v-on:user-added="updateList"></teacher-add>
                <hr class="col-12">
            </div>
        </div>
        <my-teacher-list :role="role" :group="id" :type="type" ref="myClassList"></my-teacher-list>
    </div>
</template>

<script>
export default {
    props: ['role', 'id', 'type'],
    name: "GroupTeachers",
    methods: {
        updateList () {
            this.$refs.myClassList.loadCourses()
        }
    }
}
</script>
