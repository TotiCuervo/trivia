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
                            <div class="pt-3" v-for="team in teams" v-if="teams.length !== 0">
                                <HostRoundReviewTeamRow :team="team" :question="question"></HostRoundReviewTeamRow>
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