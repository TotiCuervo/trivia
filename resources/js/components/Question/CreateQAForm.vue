<template>
    <div>
        <div v-if="this.questions">
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
                                        <button type="button" class="btn btn-success w-100" @click="qaForm"> Create
                                            Question
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

            //sets the round id from the params for question
            this.questionRoundID = this.routeParams.round_id;

            //sets the round id from the params for answer
            this.answerRoundID = this.routeParams.round_id;

            //gets all of the questions already in this trivia
            this.fetchQuestions(this.routeParams.id);

        },
        methods: {
            ...mapActions('question', ['newQuestion', 'fetchQuestions']),

            qaForm() {

                // this.assignOrderNumber();
                this.addQuestion();
                this.$router.push({name: "gameDetails", params: {id: this.routeParams.id}});

            },
            addQuestion() {

                //Adds question to database
                axios.post('/api/question/create', this.questionForm)
                    .then(response => {

                        //creates new variable to pass to answers
                        let $newQuestion = response.data;

                        //updates the question array with the newly made question
                        this.$store.commit('question/UPDATE_QUESTIONS', response.data);

                        //sets the question to be used later
                        this.$store.commit('question/SET_QUESTION', response.data);

                        //clears the form of the question store
                        this.$store.commit('question/CLEAR_FORM');

                        //going to add questions
                        this.addAnswer($newQuestion);

                    }).catch(error => {
                    console.log(error.response);
                });
            },
            addAnswer($data) {

                //assigns all of the answers to this variable
                let $answers = this.answerForm;

                //for loop to save each individual answer to the database
                for (let $i = 0; $i < $answers.length; $i++) {

                    //if it is not an empty answer, do not fill it
                    if (!($answers[$i].title === '')) {

                        let $answer = '';

                        //sets up the answer to be saved
                        if ($data.type === 'Fill-in-blank') {

                            $answer = {
                                'title': $answers[$i].title,
                                'question_id': $data.id,
                                'round_id': $data.round_id,
                                'correct': true
                            };
                        }
                        else {

                            $answer = {
                                'title': $answers[$i].title,
                                'question_id': $data.id,
                                'round_id': $data.round_id,
                                'correct': $answers[$i].correct,
                            };
                        }

                        //posts the question to the database
                        axios.post('/api/answer/create', $answer)
                            .then(response => {

                                //adds the answer to the array of answers
                                this.$store.commit('answer/UPDATE_ANSWERS', response.data);

                                //clears the answer form at the index of $i
                                this.$store.commit('answer/CLEAR_FORM', $i);

                            }).catch(error => {
                            console.log(error.response);
                        });
                    }
                }


            },

        },
        computed: {
            ...mapGetters('question', ['formQuestionRoundID', 'questions', 'questionFields']),
            ...mapGetters('answer', ['answerFields',]),

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