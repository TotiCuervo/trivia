<template>
    <div>
        <div v-if="this.questionForm">

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row pt-3">
                                    <div class="col-md-10 offset-md-1">
                                        <CreateQuestion></CreateQuestion>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-10 offset-md-1">
                                        <CreateAnswer></CreateAnswer>
                                    </div>
                                </div>
                                <div class="row pt-3 pb-5">
                                    <div class="col-md-10 offset-md-1">
                                        <hr>
                                        <button type="button" class="btn btn-success w-100">
                                            Save Question
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                routeParams: null,
            }
        },

        mounted() {

            //gets the params from the url
            this.routeParams = this.$route.params;

            //gets the answers that belong to this question
            this.fetchQuestionAnswers(this.routeParams.question_id);

            //get the question that needs to be editted
            this.fetchQuestion(this.routeParams.question_id);

        },
        methods: {
            ...mapActions('question', ['fetchQuestion']),
            ...mapActions('answer', ['fetchQuestionAnswers']),

        },
        computed: {
            ...mapGetters('question', ['formQuestionRoundID', 'questions', 'questionFields']),
            ...mapGetters('answer', ['answerFields']),

            //Questions
            questionForm: {
                get() {
                    return this.questionFields;
                },
            },
            questionRoundID: {
                get() {
                    return this.formQuestionRoundID;
                },
                set(value) {
                    this.$store.commit('question/UPDATE_ROUND_ID', value);
                }
            },
            answerQuestionID: {
                get() {
                    return this.formQuestionID;
                },
                set(value) {
                    this.$store.commit('answer/UPDATE_QUESTION_ID', value);
                }
            },

            //Answers
            answerForm: {
                get() {
                    return this.answerFields;
                },
            },
        }
    }
</script>

<style scoped>

</style>