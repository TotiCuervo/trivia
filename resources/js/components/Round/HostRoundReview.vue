<template>
    <div>
        <!--Navigation-->
        <div class="row">
            <div class="col-12 text-center">
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-lg mr-2" @click='startAnswerReveal()'>Question 1 Answer</button>
                </div>
            </div>
        </div>
        <!--Round Title-->
        <div class="row pt-3">
            <div class="col-12 text-center">
                <h3>Round Review</h3>
            </div>
        </div>
        <!--Actual Round Review-->
        <div class="row pb-5">
            <div class="col-8 offset-2">
                <div class="pt-3" v-for="question in this.questions.filter(x => x.round_id === this.rounds[playRoundPosition].id)">
                    <div class="card">
                        <div class="card-body">
                            <!--Question order-->
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted">Question {{question.order_number}}</small>
                                </div>
                            </div>
                            <!--Question Title-->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-0">{{question.title}}</h5>
                                </div>
                            </div>
                            <!--Question Possible Answers-->
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted" v-if="answers.filter(x => x.question_id === question.id && x.correct === 1).length === 1">
                                        <b>Possible Answer(s): </b>
                                        <span v-for="answer in answers.filter(x => x.question_id === question.id && x.correct === 1)">
                                            {{answer.title}}
                                        </span>
                                    </small>
                                    <small class="text-muted" v-else>
                                        <b>Possible Answer(s): </b>
                                        <span v-for="(answer, index) in answers.filter(x => x.question_id === question.id && x.correct === 1)">
                                            {{answer.title}}<span v-if="answers.filter(x => x.question_id === question.id && x.correct === 1).length !== index+1">,</span>
                                        </span>
                                    </small>
                                </div>
                            </div>
                            <!--Team Table Headers-->
                            <div class="row pt-4">
                                <div class="col-5">
                                    <small class="text-muted">Team Name</small>
                                </div>
                                <div class="col-3 pr-2">
                                    <small class="text-muted">Answer</small>
                                </div>
                                <div class="col-4">
                                    <div class="float-right">
                                        <small class="text-muted">Change Points</small>
                                    </div>
                                </div>
                            </div>
                            <!--Team information-->
                            <div class="row pt-3" v-for="team in teams" v-if="teams.length !== 0">
                                <div class="col-5">
                                    <p class="m-0">{{team.name}}</p>
                                </div>
                                <div class="col-5">
                                    <div v-if="question.type === 'Fill-in-blank'">
                                        <div v-for="answer in teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id)">
                                            <h5 class="mb-0 pointer" v-if="answer.matchIndex === 0" v-b-tooltip.left title="Correct">
                                                    <span class="badge badge-success p-2">
                                                        {{answer.answer}}
                                                    </span>
                                            </h5>

                                            <h5 class="mb-0 pointer" v-if="answer.matchIndex > 0 && answer.matchIndex <= 4" v-b-tooltip.left title="Probably correct">
                                                    <span class="badge list-group-item-success p-2">
                                                        {{answer.answer}}
                                                    </span>
                                            </h5>

                                            <h5 class="mb-0 pointer" v-else-if="answer.matchIndex > 4 && answer.matchIndex <= 7" v-b-tooltip.left title="Maybe correct">
                                                    <span class="badge list-group-item-warning p-2">
                                                        {{answer.answer}}
                                                    </span>
                                            </h5>

                                            <h5 class="mb-0 pointer" v-else-if="answer.matchIndex > 8" v-b-tooltip.left title="Probably not correct">
                                                    <span class="badge list-group-item-danger p-2">
                                                        {{answer.answer}}
                                                    </span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div v-for="answer in teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id)">
                                            <h5 class="mb-0 pointer" v-if="answer.matchIndex === 0" v-b-tooltip.left title="Correct">
                                                <span class="badge badge-success p-2">
                                                    {{answer.answer}}
                                                </span>
                                            </h5>
                                            <h5 class="mb-0 pointer" v-else v-b-tooltip.left title="Wrong">
                                                <span class="badge badge-danger p-2">
                                                    {{answer.answer}}
                                                </span>
                                            </h5>
                                        </div>

                                    </div>
                                    <h5 class="mb-0 pointer" v-if="teamAnswers.filter(x => x.team_id === team.id && x.question_id === question.id).length === 0"
                                        v-b-tooltip.left title=" ¯\_(ツ)_/¯">
                                            <span class="badge badge-danger p-2">
                                                No Answer
                                            </span>
                                    </h5>
                                </div>
                                <div class="col-2">
                                    <HostChangeAnswer :team="team" :question="question"></HostChangeAnswer>
                                </div>
                            </div>
                            <!--If there are no teams-->
                            <div class="row pt-3" v-if="teams.length === 0">
                                <div class="col-12 text-center">
                                    <h5>No teams :( Sad Day</h5>
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

            }
        },
        mounted() {

            axios.post('/api/host/'+ this.gameCode.code + '/round/' + this.playRoundPosition +'/question/' + 0 + '/currentPage/' + 'PlayRoundReview')
                .then(response => {
                    // console.log(response.data);
                });

        },
        methods: {
            startAnswerReveal() {
                for (let $i=0; $i < this.questions.length; $i++) {
                    if (this.questions[$i].round_id === this.rounds[this.playRoundPosition].id && this.questions[$i].order_number === 1) {
                        this.playQuestionPosition = $i;
                    }
                }

                axios.post('/api/host/' + this.gameCode.code + '/round/'+ this.playRoundPosition + '/question/' + this.playQuestionPosition + '/currentPage/'+'PlayRevealAnswer')
                    .then(response => {

                    });

                this.currentPage = 'HostAnswerReveal';
            },
            changeAnswer(id, change) {
                if (this.teamAnswers.find(x => x.id === id && x.correct !== change)) {


                    for (let $i = 0; $i < this.teamAnswers.length; $i++) {
                        if (this.teamAnswers[$i].id === id) {

                            this.team_Answers = {
                                answer: this.teamAnswers[$i],
                                order: $i
                            };
                        }
                    }
                }

            }
        },
        computed: {
            ...mapGetters('game', ['gameCode']),
            ...mapGetters('question', ['questions']),
            ...mapGetters('answer', ['answers']),
            ...mapGetters('round', ['rounds']),
            ...mapGetters('play', ['roundPosition', 'questionPosition', 'page']),
            ...mapGetters('team', ['teams', 'teamAnswers']),
            playRoundPosition: {
                get() {
                    return this.roundPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_ROUND_POSITION', value);
                }
            },
            playQuestionPosition: {
                get() {
                    return this.questionPosition;
                },
                set(value) {
                    return this.$store.commit('play/SET_QUESTION_POSITION', value);
                }
            },
            currentPage: {
                get() {
                    return this.page;
                },
                set(value) {
                    return this.$store.commit('play/SET_PAGE', value);
                }
            },
            team_Answers: {
                get() {
                    return this.teamAnswers;
                },
                set(value) {
                    return this.$store.commit('team/UPDATE_TEAM_ANSWER_CORRECT', value);
                }
            }
        },
    }
</script>

<style scoped>

</style>