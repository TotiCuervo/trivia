<template>
    <div class="container">
        <CreateQuestion title="New Question"></CreateQuestion>
        <CreateAnswer></CreateAnswer>

        <div class="row pt-5 pb-5">
            <div class="col-10 offset-1">
                <b-button v-if="!(validation)" disabled class="w-100" variant="success">Create Question</b-button>
                <b-button v-if="(validation)" class="w-100" variant="success" @click="qaForm">Create Question</b-button>
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
                answerCC: 30,
            }
        },
        mounted() {

            //Sets the order number that this would be;
            this.$store.commit('question/UPDATE_ORDER_NUMBER', this.questions.filter(x => x.round_id === this.currentRound.id).length + 1);

            //Set the round id for the question;
            this.$store.commit('question/UPDATE_ROUND_ID', this.currentRound.id);


        },
        methods: {
            ...mapActions('question', ['newQuestion', 'fetchQuestions']),
            ...mapActions('round', ['fetchRounds']),
            ...mapActions('game', ['fetchData']),

            qaForm() {

                this.addQuestion();
                this.$bvModal.hide('add-question');

            },
            addQuestion() {

                //Adds question to database
                axios.post('/api/question/create', this.questionForm)
                    .then(response => {

                        //updates the question array with the newly made question
                        this.$store.commit('question/ADD_QUESTION_TO_QUESTIONS', response.data);

                        //going to add questions
                        this.addAnswer(response.data);

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
                                this.$store.commit('answer/ADD_TO_ANSWERS', response.data);

                            }).catch(error => {
                            console.log(error.response);
                        });
                    }
                }


            },

        },
        computed: {
            ...mapGetters('game', ['game']),
            ...mapGetters('question', ['questions', 'questionFields']),
            ...mapGetters('answer', ['answerFields']),
            ...mapGetters('round', ['currentRound']),

            //Questions
            questionForm: {
                get() {
                    return this.questionFields;
                },
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
                    return this.answerForm[0].title.length > 0
                        && this.answerForm[1].title.length > 0
                        && this.questionForm.title.length > 0
                        && this.questionForm.title.length < 100
                        && (!!this.answerForm.find(x => x.correct))
                        && (!this.answerForm.find(x => x.title.length > this.answerCC));
            }
                else {

                    return this.answerForm[0].title.length > 0
                        && this.questionForm.title.length > 0
                        && this.questionForm.title.length < 100
                        && (!this.answerForm.find(x => x.title.length > this.answerCC));

                }


            }
        },
    }
</script>

<style scoped>


</style>
