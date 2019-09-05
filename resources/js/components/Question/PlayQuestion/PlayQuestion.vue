<template>
    <div>
        <!--QuestionProgressBar-->
        <QuestionProgressBar v-on:endTheQuestion="endTheQuestion()"></QuestionProgressBar>

        <div class="container">
            <!--Question Title-->
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{this.questions[questionPosition].title}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--Answer Input-->
            <div v-if="this.endQuestion === false">
                <!--Fill in the blank-->
                <div v-if="this.questions[questionPosition].type === 'Fill-in-blank'">
                    <FIBInput></FIBInput>
                </div>
                <!--Multiple Choice-->
                <div v-else>
                    <MCInput></MCInput>
                </div>
                <!--Submit Button-->
                <div class="row pt-3">
                    <div class="col-md-4 offset-md-4 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <b-button v-if="this.playerAnswer.length === 0" variant="success" block disabled>Submit Answer</b-button>
                                <b-button v-else variant="success" block @click="endTheQuestion()">Submit Answer</b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--After Submit-->
            <div class="row pt-5 fill-in-blank" v-else>
                <div class="col-md-4 offset-md-4 text-center">
                    <h5>Your answer has been submitted!</h5>
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
                time: 0,
                max: 0,
                timer: '',
                variantColor: 'success',
                yellowTime: '',
                redTime: '',
                endQuestion: false,
            }
        },
        mounted() {

        },
        methods: {

            endTheQuestion() {
                this.endQuestion = true;
                this.submitAnswer();
            },

            submitAnswer() {
                if (this.playerAnswer.length !== 0) {
                    axios.post('/api/teamAnswers/store', {
                        answer: this.playerAnswer,
                        round_id: this.rounds[this.roundPosition].id,
                        question_id: this.questions[this.questionPosition].id,
                        team_id: this.team.id,
                        gameCode: this.team.gameCode,
                    }).then(response => {
                        this.$store.commit('team/ADD_TEAM_ANSWER', response.data);
                        this.playerAnswer = '';
                    });
                }
            },
            selectAnswer(answer) {
                this.answer = answer.title;
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers', 'answer']),
            ...mapGetters('team', ['team']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            playerAnswer: {
                get() {
                    return this.answer;
                },
                set(value) {
                    this.$store.commit('answer/SET_ANSWER',value);
                }
            }
        },
        watch: {
            questionPosition: function () {
                this.endQuestion = false;
            },

        }

    }
</script>

<style scoped>

</style>