<template>
    <div class="row">
        <div v-for="answer in answers" class="col-12">

            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" :for="'answer-' + answer.id">
                        <input type="radio" :id="'answer-' + answer.id" :name="'answer-' + question" :aria-label="answer.option">
                    </label>
                </div>
                <p class="form-control">{{ answer.option }}</p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ['answers', 'question'],
    name: "Answer"
}
</script>

<style scoped>

</style>
