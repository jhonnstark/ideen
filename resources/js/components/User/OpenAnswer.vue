<template>
    <div class="row">
        <div class="col-12">
            <label for="exampleFormControlTextarea1" class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: ['answers', 'question'],
    name: "OpenAnswer"
}
</script>

<style scoped>

</style>
