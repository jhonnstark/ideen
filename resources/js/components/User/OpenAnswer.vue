<template>
    <div class="row">
        <div class="col-12">
            <label for="exampleFormControlTextarea1" class="form-group">
                <textarea v-model="answer" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: ['question'],
    name: "OpenAnswer",
    data() {
        return {
            answer: ''
        }
    }
}
</script>

<style scoped>

</style>
