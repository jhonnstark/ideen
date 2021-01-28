<template>
    <div class="container">
        <div class="row">
            <div class="col">
            {{ question.quiz }}
            </div>
        </div>
        <answer v-if="question.type === 'choice'" :answers="question.answers" :question="question.id"></answer>
        <open-answer v-else :answers="question.answers" :question="question.id"></open-answer>
    </div>
</template>

<script>
export default {
    props: ['question'],
    name: "Question"
}
</script>

<style scoped>

</style>
