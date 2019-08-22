<template>
    <div>
        <div class="row no-gutters" v-if="this.rounds[roundPosition].time">
            <div class="col-md-12">
                <b-progress height="8px" :max="max">
                    <b-progress-bar :value="time" :variant="variantColor">
                    </b-progress-bar>
                </b-progress>
            </div>
        </div>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{this.questions[questionPosition].title}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="this.endQuestion === false">
                <div class="row pt-5 fill-in-blank" v-if="this.questions[questionPosition].type === 'Fill-in-blank'">
                    <div class="col-md-4 offset-md-4 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <b-form-input id="input-large" size="lg" placeholder="Enter your answer" v-model="answer"></b-form-input>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                <b-button v-if="this.answer.length === 0" variant="success" block disabled>Submit Answer</b-button>
                                <b-button v-else variant="success" block @click="submitAnswer()">Submit Answer</b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-3 fill-in-blank" v-else>
                    <div class="col-md-4 offset-md-4 text-center">
                        <div v-for="answerCard in this.answers">
                            <div class="row pb-3" v-if="answerCard.question_id === questions[questionPosition].id">
                                <div class="col-md-12 text-center">
                                    <div class="fancy2 card clicker" @click="selectAnswer(answerCard)" v-bind:class="{isChosen: answer === answerCard.title}">
                                        <div class="card-body p-2">
                                            <h5 class="mb-0">{{answerCard.title}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                <b-button v-if="this.answer.length === 0" variant="success" block disabled>Submit Answer</b-button>
                                <b-button v-else variant="success" block @click="submitAnswer()">Submit Answer</b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                answer: '',
                time: 0,
                max: 0,
                variantColor: 'success',
                yellowTime: '',
                redTime: '',
                endQuestion: false,
            }
        },
        mounted() {
            this.startTimer();

            Echo.join('game.'+this.team.gameCode)
                .here((users) => {

                })
                .listen('StartQuestion', (e) => {
                    console.log('just got new question');
                    this.variantColor = 'success';
                    this.endQuestion = false;
                    this.answer = '';
                    this.startTimer();
                });
        },
        methods: {
            startTimer() {
                this.time = this.rounds[this.roundPosition].time;
                this.max = this.rounds[this.roundPosition].time;
                this.yellowTime = (this.rounds[this.roundPosition].time/3) + (this.rounds[this.roundPosition].time/3);
                this.redTime = this.rounds[this.roundPosition].time/3;
                let vm = this;
                let timer = setInterval(function() {
                    vm.time -= 1;

                    if (vm.time <= vm.yellowTime && vm.time > vm.redTime) {
                        vm.variantColor = 'warning';
                    }

                    if (vm.time <= vm.redTime) {
                        vm.variantColor = 'danger';
                    }

                    if (vm.time === -1) {
                        clearInterval(timer);
                        vm.endQuestion = true;
                    }
                }, 1000);
            },
            submitAnswer() {
                axios.post('/api/teamAnswers/store', {
                    answer: this.answer,
                    round_id: this.rounds[this.roundPosition].id,
                    question_id: this.questions[this.questionPosition].id,
                    team_id: this.team.id,
                    gameCode: this.team.gameCode,
                }).then(response => {
                    // console.log(response.data);
                    this.$store.commit('team/ADD_TEAM_ANSWER', response.data);
                    this.endQuestion = true;
                });
            },
            selectAnswer(answer) {
                this.answer = answer.title;
            }
        },
        computed: {
            ...mapGetters('round', ['rounds']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('team', ['team']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
        }
    }
</script>

<style scoped>

</style>