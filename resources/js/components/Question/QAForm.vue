<template>
    <div>
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <CreateQuestion></CreateQuestion>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <CreateAnswer></CreateAnswer>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-success" @click="addQuestion"> Create Question </button>
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
                burpy: null,
            }
        },
        mounted() {
            this.routeParams = this.$route.params;
            this.questionRoundID = this.routeParams.round_id;
            this.answerRoundID = this.routeParams.round_id;

        },
        methods:{
            ...mapActions('question', ['newQuestion']),
            qaForm()
            {
                this.addQuestion();

            },
            addQuestion() {

                axios.post('/api/question/create', this.questionForm)
                    .then(response => {

                        this.$store.commit('question/UPDATE_QUESTIONS', response.data);
                        this.$store.commit('question/SET_QUESTION', response.data);
                        this.$store.commit('question/CLEAR_FORM');

                        this.answerQuestionID = this.question.id;

                        this.addAnswer();

                    }).catch( error => {
                    console.log(error.response);
                });
                // this.$router.push({ name: "showGame", params: { id: this.routeParams.id }});
            },
            addAnswer()
            {
                console.log("Made it in answer");
                console.log(this.answerForm);
                console.log('poop');

                axios.post('/api/answer/create', this.answerForm)
                    .then(response => {
                        console.log(response.data);
                        this.$store.commit('UPDATE_ANSWERS', response.data);
                        this.$store.commit('answer/CLEAR_FORM');

                        this.$router.push({ name: "showGame", params: { id: this.routeParams.id }});

                    }).catch( error => {
                    console.log(error.response);
                });


            },
        },
        computed: {
            ...mapGetters('question', ['formQuestionRoundID', 'question', 'questionFields']),
            ...mapGetters('answer', ['formAnswerRoundID','formQuestionID', 'answerFields', 'formCorrect']),

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
            answerCorrect: {
                get() {
                    return this.formCorrect;
                },
                set() {
                    this.$store.commit('answer/UPDATE_CORRECT', value);
                }
            },
            answerRoundID: {
                get() {
                    return this.formAnswerRoundID;
                },
                set(value) {
                    this.$store.commit('answer/UPDATE_ROUND_ID', value);
                }
            },

        }
    }
</script>

<style scoped>

</style>