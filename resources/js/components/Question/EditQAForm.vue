<template>
    <div v-if="!(this.answerForm[0].title === '')">
        <div>
            <div class="row no-gutters pt-5 pb-5">
                <div class="col-md-6 offset-md-3">
                    <div class="trivalo-card card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="float-right fa-2x clicker color-gray then-black trans-1" @click="exitPage"><i class="far fa-times-circle"></i></span>
                                    </div>
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
                                        <b-button v-if="!(validation)" disabled class="w-100" variant="success">Save Question</b-button>
                                        <b-button v-if="(validation)" class="w-100" variant="success" @click="saveChanges">Save Question</b-button>
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

            this.$store.commit('answer/CLEAR_ALL_FORM');
            //gets the answers that belong to this question
            this.fetchQuestionAnswers(this.routeParams.question_id);

            //not important for this problem
            //get the question that needs to be edited
            this.fetchQuestion(this.routeParams.question_id);

        },
        methods: {
            ...mapActions('question', ['fetchQuestion','question']),
            ...mapActions('answer', ['fetchQuestionAnswers', 'CLEAR_ALL_FORM']),
            ...mapActions('game', ['fetchData']),

            exitPage() {
                this.$store.commit('question/CLEAR_FORM');
                this.$store.commit('answer/CLEAR_ALL_FORM');
                this.$store.commit('question/CLEAR_CURRENT_QUESTION');
                this.$store.commit('round/CLEAR_ROUND');
                this.$router.push({name: "gameDetails", params: {id: this.routeParams.id}});
            },
            saveChanges()  {
                this.saveQuestion();
                this.saveAnswers();
                this.$store.commit('question/CLEAR_CURRENT_QUESTION');
                this.$store.commit('round/CLEAR_ROUND');

                this.$router.push({name: "gameDetails", params: {id: this.routeParams.id}});
            },
            saveQuestion() {

                if(!(this.questionForm.title === this.question_object.title))
                {
                    axios.post('/api/question/' + this.questionForm.id, {
                        data: this.questionForm,
                        _method: 'patch'
                    })
                        .then(response => {
                            // console.log(response.data);
                            this.$store.commit('question/CLEAR_FORM');
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            },
            saveAnswers() {

                for (let $i = 0; $i < this.answerForm.length; $i++) {

                    if ($i < this.answerArray.length) {

                        if (!(this.answerForm[$i].title === '')) {

                            if( !(this.answerForm[$i].title === this.answerArray[$i].title) || !(this.answerForm[$i].correct === this.answerArray[$i].correct)) {
                                axios.post('/api/answer/' + this.answerForm[$i].id, {
                                    data: this.answerForm[$i],
                                    _method: 'patch'
                                })
                                    .then(response => {
                                        // console.log(response.data);
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                            }

                        } else {

                            axios.delete('/api/answer/' + this.answerArray[$i].id +'/destroy')
                                .then(response => {
                                    console.log(response.data);
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                        }

                    } else {

                        if(!(this.answerForm[$i].title === '')) {

                                let $answer = '';

                                //sets up the answer to be saved
                                if (this.questionForm.type === 'Fill-in-blank') {

                                    $answer = {
                                        'title': this.answerForm[$i].title,
                                        'question_id': this.answerForm[0].question_id,
                                        'round_id': this.answerForm[0].round_id,
                                        'correct': true
                                    };
                                }
                                else {

                                    $answer = {
                                        'title': this.answerForm[$i].title,
                                        'question_id': this.answerForm[0].question_id,
                                        'round_id': this.answerForm[0].round_id,
                                        'correct': this.answerForm[$i].correct,
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

                }



            },

        },
        computed: {
            ...mapGetters('question', ['formQuestionRoundID', 'currentQuestion', 'questionFields']),
            ...mapGetters('answer', ['answerFields', 'answers']),

            //Questions
            questionForm: {
                get() {
                    return this.questionFields;
                },
            },
            question_object: {
                get() {
                    return this.currentQuestion
                },
                set(value) {
                    return this.$store.commit('question/SET_QUESTION', value);
                }
            },

            //Answers
            answerForm: {
                get() {
                    return this.answerFields;
                },
            },
            answerArray: {
                get() {
                    return this.answers;
                }
            },
            validation() {

                if (this.questionForm.type === 'Multiple-Choice') {
                    return this.answerForm[0].title.length > 0 && this.answerForm[1].title.length > 0 && this.questionForm.title.length > 0 && this.questionForm.title.length < 100;
                }
                else {

                    return this.answerForm[0].title.length > 0 && this.questionForm.title.length > 0 && this.questionForm.title.length < 100;

                }
            }
        },
    }
</script>

<style scoped>

</style>
