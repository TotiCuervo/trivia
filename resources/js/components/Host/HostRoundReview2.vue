<template>
    <div>
        <!--SubHeader-->
        <div class="row pb-3 pt-3 host-subHeader">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">

                    <!--left-->
                    <h5 class="m-0">Round Review</h5>

                    <!--right-->
                    <div class="flex-grow-1">
                        <b-button pill class="float-right" variant="primary" @click='startAnswerReveal()'>Question 1 Answer</b-button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-5 pt-3 justify-content-center">
            <div class="col-md-6 pt-2">
                <div class="hostQuestion-card card">
                    <div class="card-body">
                        <div class="row p-5">
                            <div class="col-md-12 text-center">
                                <h4 class="m-0">{{this.questions[this.playQuestionPosition].title}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Content-->
        <!--Round Title-->
        <!--Actual Round Review-->
        <div class="row pb-5 pt-3">
            <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
                <div class="pt-3" v-for="question in this.questions.filter(x => x.round_id === this.rounds[playRoundPosition].id)">
                    <div class="trivalo-card card">
                        <div class="card-body">
                            <!--Question Title-->
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="mb-0"><b>Question {{question.order_number}}:</b> {{question.title}}</h6>
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
                            <!--Team Headers-->
                            <div class="row pt-4 pb-4">
                                <div class="col-4 col-md-3">
                                    <small class="text-muted">Team Name</small>
                                </div>
                                <div class="col-4 col-md-4 pr-2">
                                    <small class="text-muted">Answer</small>
                                </div>
                                <!--Disappears when screen is too small-->
                                <div class="col-2 pr-2 d-none d-md-flex">
                                    <small class="text-muted">Grade</small>
                                </div>
                                <div class="col-4 col-md-3">
                                    <div class="float-right">
                                        <small class="text-muted">Change Points</small>
                                    </div>
                                </div>
                            </div>
                            <!--Team information-->
                            <div v-for="(team, index) in teams" v-if="teams.length !== 0">
                                <HostRoundReviewTeamRow :team="team" :question="question" :index="index"></HostRoundReviewTeamRow>
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
