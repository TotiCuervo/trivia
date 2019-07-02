<template>
    <div>
        <div v-for="answer in answers">
            <div v-if="answer.question_id === question_id">
                <h5 class="pl-5">{{answer.title}}</h5>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data() {
            return {
                id: null,
            }
        },
        mounted() {
            this.id = this.$route.params;
            // this.fetchQuestions(this.id.id);
        },
        methods:{
            ...mapActions('answer', ['fetchanswers']),
        },
        computed: {
            ...mapGetters('answer', ['answers']),
        },
        props: ['question_id'],
    }
</script>

<style scoped>

</style>