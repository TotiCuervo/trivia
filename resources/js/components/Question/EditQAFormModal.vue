<template>
    <div class="container" v-if="!(this.answerForm[0].title === '')">
        <CreateQuestion title="Edit Question"></CreateQuestion>
        <CreateAnswer></CreateAnswer>

        <div class="row pt-5 pb-5">
            <div class="col-10 offset-1">
                <b-button v-if="!(validation)" disabled class="w-100" variant="success">Save Question</b-button>
                <b-button v-if="(validation)" class="w-100" variant="success" @click="saveChanges()">Save Question</b-button>
            </div>
        </div>
    </div>
</template>


<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                oldAnswerForm: [],
                oldQuestionForm: {},
                answerCC: 30,
            }
        },
        mounted() {

            for (let $i = 0; $i < this.answerForm.length; $i++) {
                this.oldAnswerForm.push({
                    title: this.answerForm[$i].title,
                    correct: this.answerForm[$i].correct,
                    id: this.answerForm[$i].id
                });
            }

            this.oldQuestionForm = {
                id: this.questionForm.id,
                title: this.questionForm.title,
                type: this.questionForm.type,
                round_id: this.questionForm.round_id,
                order_number: this.questionForm.order_number
            };

        },
        methods: {
            ...mapActions('question', ['fetchQuestion','question']),
            ...mapActions('answer', ['fetchQuestionAnswers', 'CLEAR_ALL_FORM']),
            ...mapActions('game', ['fetchData']),

            saveChanges()  {
                this.saveQuestion();
                this.saveAnswers();

                //clears the form of the question store
                this.$store.commit('question/CLEAR_FORM');
                //Clears all the forms for the answers;
                this.$store.commit('answer/CLEAR_ALL_FORM');

                this.$bvModal.hide('edit-question');
            },
            saveQuestion() {

                if (this.questionForm !== this.oldQuestionForm)
                {
                    axios.post('/api/question/' + this.questionForm.id, {
                        data: this.questionForm,
                        _method: 'patch'
                    })
                        .then(response => {
                            this.$store.commit('question/CLEAR_FORM');
                            this.$store.commit('question/UPDATE_QUESTION_IN_QUESTIONS', response.data);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }

                if (this.questionForm.type === 'Fill-in-blank') {

                    for (let $i = 0; $i < this.answerForm.length; $i++) {
                        if (!this.answerForm[$i].correct) {
                            this.$store.commit('answer/UPDATE_CORRECT', $i);
                        }
                    }
                }

            },
            saveAnswers() {

                //iterate through old answer form
                for (let $i = 0; $i < this.oldAnswerForm.length; $i++) {

                    let $differentTitle = this.answerForm[$i].title !== this.oldAnswerForm[$i].title;
                    let $differentCorrect = this.answerForm[$i].correct !== this.oldAnswerForm[$i].correct;

                    //if its empty, delete
                    if (this.answerForm[$i].title === '' && this.oldAnswerForm[$i].id) {

                        axios.delete('/api/answer/' + this.oldAnswerForm[$i].id +'/destroy')
                            .then(response => {
                                this.$store.commit('answer/DELETE_FROM_ANSWERS', this.oldAnswerForm[$i]);
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }

                    //if it is different and in old array, update
                    else if (($differentTitle || $differentCorrect) && this.oldAnswerForm[$i].id) {

                        axios.post('/api/answer/' + this.oldAnswerForm[$i].id, {
                            data: {
                                title: this.answerForm[$i].title,
                                question_id: this.answerForm[0].question_id,
                                round_id: this.answerForm[0].round_id,
                                correct: (this.questionForm.type === 'Fill-in-blank') ? true : this.answerForm[$i].correct,
                            },
                            _method: 'patch'
                        })
                            .then(response => {
                                this.$store.commit('answer/UPDATE_ANSWERS', response.data);
                            })
                            .catch(error => {
                                console.log(error);
                            });

                    }

                    //if it is a new answer, add
                    else if (this.answerForm[$i].title !== this.oldAnswerForm[$i].title && !this.oldAnswerForm[$i].id) {

                        axios.post('/api/answer/create', {
                            title: this.answerForm[$i].title,
                            question_id: this.answerForm[0].question_id,
                            round_id: this.answerForm[0].round_id,
                            correct: (this.questionForm.type === 'Fill-in-blank') ? true : this.answerForm[$i].correct,
                        }).then(response => {

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
                    return this.answerForm[0].title !== ' '
                        && this.answerForm[0].title.length > 0
                        && this.answerForm[1].title.length > 0
                        && this.questionForm.title.length > 0
                        && this.questionForm.title.length < 100
                        && (!!this.answerForm.find(x => x.correct))
                        && (!this.answerForm.find(x => x.title.length > this.answerCC));

                }
                else {

                    return this.answerForm[0].title !== ' '
                        && this.answerForm[0].title.length > 0
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
