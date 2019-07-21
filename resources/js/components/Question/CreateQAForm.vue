<template>
    <div>
        <div>
            <!--<h5>this.answerForm[0].title.length > 0:</h5>-->
            <!--<h5>{{this.answerForm[0].title.length > 0}}</h5>-->

            <!--<h5>this.questionForm.title.length > 0:</h5>-->
            <!--<h5>{{this.questionForm.title.length > 0}}</h5>-->

            <!--<h5>this.questionForm.title.length < 100:</h5>-->
            <!--<h5>{{this.questionForm.title.length < 100}}</h5>-->

            <!--<h5>All:</h5>-->
            <!--<h5>{{this.answerForm[0].title.length > 0 && this.questionForm.title.length > 0 && this.questionForm.title.length < 100}}</h5>-->

            <!--<GameHeader></GameHeader>-->
            <div class="row no-gutters pt-5 pb-5">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <i class="far fa-times-circle fa-2x clicker fa-gray fa-hover-black" @click="exitPage"></i>
                                </div>
                                <div class="row pt">
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
                                        <b-button v-if="!(validation)" disabled class="w-100" variant="success">Create Question</b-button>
                                        <b-button v-if="(validation)" class="w-100" variant="success" @click="qaForm">Create Question</b-button>

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

            //clears the form of the question store
            if (!(this.questionForm.title === ''))
            {
                this.$store.commit('question/CLEAR_FORM');
            }

            //Clears all the forms for the answers;
            this.$store.commit('answer/CLEAR_ALL_FORM');

            //gets the params from the url
            this.routeParams = this.$route.params;

            //sets the round id from the params for question
            this.questionRoundID = this.routeParams.round_id;

            //sets the round id from the params for answer
            this.answerRoundID = this.routeParams.round_id;

            //gets all of the questions already in this trivia
            this.fetchQuestions(this.routeParams.id);

            this.fetchRounds(this.routeParams);

        },
        beforeCreate: function() {
            document.body.className = 'game-creator';
        },
        methods: {
            ...mapActions('question', ['newQuestion', 'fetchQuestions']),
            ...mapActions('round', ['fetchRounds']),


            qaForm() {

                this.setOrderNumber();
                this.addQuestion();
                this.$store.commit('question/CLEAR_CURRENT_QUESTION');
                this.$store.commit('round/CLEAR_ROUND');
                // this.$store.commit('round/UPDATE_ROUND_BY_ID', this.routeParams.round_id);
                this.$router.push({name: "gameDetails", params: {id: this.routeParams.id}});

            },
            setOrderNumber() {

                //sets the order number for this question
                let $orderNumber = 1;

                for (let $i = 0; $i < this.questions.length; $i++)
                {

                    if(this.questions[$i].round_id === parseInt(this.routeParams.round_id, 10))
                    {
                        $orderNumber++;
                    }
                }

                this.$store.commit('question/UPDATE_ORDER_NUMBER', $orderNumber);

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

                        //clears the current question otherwise it will stay
                        this.$store.commit('question/CLEAR_CURRENT_QUESTION');

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

                        // console.log('at the answer post');
                        // console.log($answer);


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
            exitPage()
            {
                this.$store.commit('question/CLEAR_CURRENT_QUESTION');
                this.$store.commit('round/CLEAR_ROUND');
                this.$router.push({name: "gameDetails", params: {id: this.routeParams.id}});
            }

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
            //For Validation
            validation() {

                if (this.questionForm.type === 'Multiple-Choice') {
                    return this.answerForm[0].title.length > 0 && this.answerForm[1].title.length > 0 && this.questionForm.title.length > 0 && this.questionForm.title.length < 100;
                }
                else {

                    return this.answerForm[0].title.length > 0 && this.questionForm.title.length > 0 && this.questionForm.title.length < 100;

                }


            }
        }
    }
</script>

<style scoped>

    body {
        background-color: black;
    }

</style>