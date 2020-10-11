<template>

    <div class="container">
        <div class="row justify-content-center">
            sgdfg
        </div>
    </div>

</template>

<script>
export default {
    name: "Detail",
    props: ['id'],
    data: function () {
        return {
            item: JSON.parse(this.id),
            file: null
        }
    },
    created () {
        axios
            .get(window.location.pathname)
            .then(response => (this.file = response.data.data))
    },
}
</script>

<style scoped>

</style>

