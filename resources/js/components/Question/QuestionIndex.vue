<template>
    <div>

        <div class="container">
            <!--if there are questions in the array-->
            <div v-for="question in questions">
                <!--and they match the round id of this round-->
                <div v-if="question.round_id === round_id">
                    <div class="row pb-3">
                        <div class="col-md-12 pr-2">
                            <QuestionIndexCard :question="question" :round_id="round_id"></QuestionIndexCard>
                        </div>
                    </div>
                </div>
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
                clicked: false,
            }
        },
        mounted() {
            // this.id = this.$route.params;
            // this.fetchQuestions(this.id.id);
        },
        methods: {
            ...mapActions('question', ['fetchQuestions']),
        },
        computed: {
            ...mapGetters('question', ['questions']),
        },
        props: ['round_id'],
    }
</script>

<style scoped>

</style>